<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index(Request $request) {
        $filters = $request->only(['publisher']);
        $buku = Buku::with([]);
        if(!empty($filters['publisher'])){
            $buku = $buku->where('publisher','LIKE','%'.$filters['publisher'].'%');
        }
        $buku = $buku->orderBy('id','desc')->paginate(10);
        return view('buku.index', compact('buku', 'filters'));
    }

    public function storeBook(Request $request, $id = null) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'publisher' => 'required|max:255',
                'desc' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('book')->with([
                    'message' => 'make sure you have filled out the form correctly!',
                    'style' => 'danger'
                ]);
            }

            $book = ($id != null) ? Buku::with([])->where('id', $id)->first() : new Buku();
            $book->title = $request->title;
            $book->publisher = $request->publisher;
            $book->desc = $request->desc;
            $book->status = 'Ready';
            $book->save();
            if($id) {
                return redirect('book')->with([
                    'message' => 'Update book success',
                    'style' => 'success'
                ]);
            } else {
                return redirect('book')->with([
                    'message' => 'Store book success',
                    'style' => 'success'
                ]);
            }

        } catch (\Exception $e) {
            return redirect('book')->with([
                'message' => 'Store book func error : '.$e->getMessage(),
                'style' => 'danger'
            ]);
        }
    }

    public function detailBook($id = null) {
        $book = Buku::with([])->find($id);
        if(!$book) {
            return redirect('book')->with([
                'message' => 'There is no book with this ID',
                'style' => 'danger'
            ]);
        }

        return view('buku.detail', compact('book'));
    }

    public function deleteBook($id = null) {
        try {
            $book = Buku::with([])->find($id);
            if(!$book) {
                return redirect('book')->with([
                    'message' => 'There is no book with this ID',
                    'style' => 'danger'
                ]);
            }
            $book->delete();
            return redirect('book')->with([
                'message' => 'Delete book success',
                'style' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect('book')->with([
                'message' => 'Delete book func error : '.$e->getMessage(),
                'style' => 'danger'
            ]);
        }
    }
}
