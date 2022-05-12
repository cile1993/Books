<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function getBooks($id)
    {
        $book = Book::where('id', '=', $id)->first();

        return response()->json( $book );
    }
}