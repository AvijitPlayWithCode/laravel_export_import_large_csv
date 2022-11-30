<?php

namespace App\Http\Controllers;

use App\Jobs\ImportCsv;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload-form');
    }

    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csv' => 'required|mimes:csv,xlsx'
        ]);

        try {
            $file = $request->file('csv');
            $csvArray = array_map('str_getcsv', file($file));

            // Extract header field from array
            $header = $csvArray[0];
            unset($csvArray[0]);

            // make chunk of data array
            $chunkArray = array_chunk($csvArray, 1000);

            foreach ($chunkArray as $key => $chunk) {
                ImportCsv::dispatch($header, $key, $chunk);
            }
            return "Done";
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
