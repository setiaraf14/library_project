<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register() {
        return view('auth.register');
    }

    public function detail(){
        return view('user.profile');
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'password' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                return redirect('book')->with([
                    'message' => 'make sure you have filled out the form correctly!',
                    'style' => 'danger'
                ]);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->level = 'Non-Admin';
            $user->save();

            return redirect()->back()->with([
                'message' => 'Success store user',
                'style' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => "Err func store user in ProfileController : " . $e->getMessage(),
                'style' => 'danger'
            ]);
        }
    }

    public function edit(Request $request, $id) {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return redirect('profile')->with([
                    'message' => 'make sure you have filled out the form correctly!',
                    'style' => 'danger'
                ]);
            }

            $user = User::with([])->find($id);
            if(!$user) {
                return redirect('profile')->with([
                    'message' => 'there is no user for this id!',
                    'style' => 'danger'
                ]);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return redirect('profile')->with([
                'message' => 'Success change password',
                'style' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect('profilet')->with([
                'message' => "Err func edit in ProfileController : " . $e->getMessage(),
                'style' => 'danger'
            ]);
        }
    }

    public function changePassword(Request $request) {
        try {
            $userChange = Auth::user();
            if (!Hash::check($request->current_password, $userChange->password)) {
                return redirect('profile')->with([
                    'message' => 'Your current password is incorrect !',
                    'style' => 'danger'
                ]);
            }

            if (Hash::check($request->new_password, $userChange->password)) {
                return redirect('profile')->with([
                    'message' => 'The new password cannot be the same as the current password !',
                    'style' => 'danger'
                ]);
            }

            if($request->new_password !== $request->password_confirmation){
                return redirect('profile')->with([
                    'message' => 'Confirmation password does not match !',
                    'style' => 'danger'
                ]);
            }

            $chekUser = User::all();
            $chekUser = $chekUser->find(Auth::user()->id);
            if (!$chekUser) {
                return redirect('profile')->with([
                    'message' => 'User doest not exist !',
                    'style' => 'danger'
                ]);
            }

            $chekUser->password = Hash::make($request->new_password);
            $chekUser->save();
            return redirect('profile')->with([
                'message' => 'Success change password',
                'style' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect('profile')->with([
                'message' => "Err func changePassword in ProfileController : " . $e->getMessage(),
                'style' => 'danger'
            ]);
        }
    }

    public function listMember() {
        $me = Auth::user();
        $member = User::with([])->where('id','!=', $me->id);
        $member = $member->get();
        return view('user.list-user', compact('member'));
    }

    public function delete($id){
        try {
            $user = User::with([])->find($id);
            if(!$user) {
                return redirect('profile')->with([
                    'message' => 'there is no user for this id!',
                    'style' => 'danger'
                ]);
            }
            $user->delete();
            return redirect('profile/list')->with([
                'message' => 'Success delete member',
                'style' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect('profile/list')->with([
                'message' => "Err func delete user : " . $e->getMessage(),
                'style' => 'danger'
            ]);
        }
    }
}
