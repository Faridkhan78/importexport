<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ExcelController extends Controller
{
    public function index()
    {
        return view('export');
    }
    // public function import(Request $request) {
    //     // Excel::import(new UsersImport, 'users.xlsx');
    //     return redirect('/')->with('success', 'All good!');
    // }
    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        foreach ($fileContents as $line) {
            $data = str_getcsv($line);
            if($data[2] == 'active'){
                $status = 1;
            }else{
                $status = 0;
             }
            Product::create([
                'name' => $data[0],
                'date' => $data[1],
                'status' => $status,
                // Add more fields as needed
            ]);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
    public function export()
    {
        $products = Product::all();
        $csvFileName = 'products.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['name', 'date','status']); // Add more headers as needed

        foreach ($products as $product) {
            fputcsv($handle, [$product->name, $product->date,$product->status]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
        //return Excel::download(new File($csvFileName));
       // Excel::class()->export($csvFileName());
    }
}
