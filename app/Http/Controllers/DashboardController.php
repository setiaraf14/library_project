<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(){
        $buku = Buku::with([])->get();
        $user = User::with([])->get();
        $buku = $buku->count();
        $user = $user->count();
        return view('dashboard', compact('buku', 'user'));
    }
}
