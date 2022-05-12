<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function getBooks(Request $request, $ids)
    {

        $ids = request('ids');
        $data = explode(',',$ids); // Take values separated by comma and put them into $data
        $str='';
        $i=1; // to append AND in query

        foreach ($data as $key => $value) {
            $str .= 'FIND_IN_SET("'.$value.'" ,ids)';
            if($i < count($data)){
                $str .=' AND ';
            }
            $i++;
        }
        $resp = [];

        foreach ($data as $k => $v)
        {
            $book = Book::where('id', '=', $v)->get();
            array_push($resp, $book);
        }
        return response()->json([$resp],200 );
    }
}