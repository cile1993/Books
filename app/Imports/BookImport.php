<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Throwable;

class BookImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'name'          => $row['naziv_knjige'],
            'author'        => $row['autor'],
            'publisher'     => $row['izdavac'],
            'year'          => Carbon::createFromFormat('d/m/Y', $row['godina_izdanja']),
        ]);
    }
}
