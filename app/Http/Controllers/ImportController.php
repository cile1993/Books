<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\BookImport;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\Book;

use Yajra\DataTables\DataTables;

class ImportController extends Controller
{

    public function index()
    {
        return view('excel-csv-import');
    }

    // Parse XML to check for spaces and replace them with underscores
    public function convertXmlToCsvFile(Request $request, $xml_file_input, $csv_file_output)
    {
        $xml = file_get_contents($request->file('file'));
        $regex = '/\s+(?=[\s\w]*>)/i';
        $rep = preg_replace($regex, '_', $xml);
        $xmlObject = simplexml_load_string($rep);
        $output_file = fopen($csv_file_output, 'w');
        $headers = array();

        // Iterate through and write valid csv file
        foreach($xmlObject->row->children() as $field)
        {
            $headers[] = $field->getName();
        }
        fputcsv($output_file, $headers, ',', '"');

        foreach ($xmlObject->row as $rows)
        {
            fputcsv($output_file, get_object_vars($rows), ',', '"');
        }
        fclose($output_file);
        }

    public function importExcelCSV(Request $request)
    {
            if ($request->file('file')->extension() == 'xml') {
                $this->convertXmlToCsvFile($request, storage_path('app') . '/' . 'file.csv', storage_path('app') . '/' . 'modified.csv');
                Excel::import(new BookImport,storage_path('app') . '/' . 'modified.csv');
            } else {
                Excel::import(new BookImport,$request->file('file'));
            }
        return redirect('/')->with('status', 'The file has been imported to database');
    }

    public function getBooks(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::latest()->get();
            return Datatables::of($data)
                ->make(true);
        }
        $data = Book::all();
        return DataTables::of($data);
    }
}
