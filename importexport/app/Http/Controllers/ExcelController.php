<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Product;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

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

    // public function import(Request $request)
    // {

    //     // Validate the file
    //     // $request->validate([
    //     //     'file' => 'required|mimes:csv,txt|max:2048', // Ensure it's a CSV or TXT file and within 2MB
    //     // ]);

    //     $file = $request->file('file');
    //     $fileContents = file($file->getPathname());





    //     foreach ($fileContents as $line) {
    //         $data = str_getcsv($line);
    //         // validation 
    //         // Validate CSV row data
    //         // if (count($data) < 3) {
    //         //     return redirect()->back()->withErrors(['error' => 'Invalid file format.']);
    //         // }

    //         // if (!in_array(strtolower($data[2]), ['active', 'inactive'])) {
    //         //     return redirect()->back()->withErrors(['error' => 'Invalid status value in CSV file.']);
    //         // }

    //         // validation
    //         if ($data[2] == 'active') {
    //             $status = 1;
    //         } else {
    //             $status = 0;
    //         }
    //         Product::create([
    //             'name' => $data[0],
    //             'date' => $data[1],
    //             'status' => $status,
    //             // Add more fields as needed
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'CSV file imported successfully.');
    // }

    // public function import(Request $request)
    // {
    //     // Validate the file
    //     $request->validate([
    //         'file' => 'required|mimes:csv,txt|max:2048', // Ensure it's a CSV or TXT file and within 2MB
    //     ]);

    //     $file = $request->file('file');

    //     // Read file contents
    //     $fileContents = file($file->getPathname());
    //     $headerSkipped = false;

    //     foreach ($fileContents as $line) {
    //         if (!$headerSkipped) {
    //             $headerSkipped = true; // Skip the first line (header)
    //             continue;
    //         }

    //         $data = str_getcsv($line);

    //         // Validate CSV row data
    //         if (count($data) < 3) {
    //             return redirect()->back()->withErrors(['error' => 'Invalid file format.']);

    //         }

    //         if (!in_array(($data[2]), ['active', 'inactive'])) {
    //             return redirect()->back()->withErrors(['error' => 'Invalid status value in CSV file.']);

    //         }

    //         // Determine status
    //         $status = strtolower($data[2]) === 'active' ? 1 : 0;

    //         // Create the product
    //         Product::create([
    //             'name' => $data[0],
    //             'date' => $data[1],
    //             'status' => $status,
    //             // Add more fields as needed
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'CSV file imported successfully.');
    // }
    //     public function import(Request $request)
    // {
    //     // Validate the file
    //     $request->validate([
    //         'file' => 'required|mimes:csv,txt|max:2048', // Ensure it's a CSV or TXT file and within 2MB
    //     ]);

    //     $file = $request->file('file');
    //     $fileContents = file($file->getPathname());
    //     $headerSkipped = false;
    //     $errors = [];
    //     $lineNumber = 1;

    //     foreach ($fileContents as $line) {
    //         if (!$headerSkipped) {
    //             $headerSkipped = true; // Skip the first line (header)
    //             $lineNumber++;
    //             continue;
    //         }

    //         $data = str_getcsv($line);

    //         // Validate CSV row data
    //         if (count($data) < 3) {
    //             $errors[] = "Line $lineNumber: Missing required fields.";
    //             $lineNumber++;
    //             continue;
    //         }

    //         if (!in_array(strtolower($data[2]), ['active', 'inactive'])) {
    //             $errors[] = "Line $lineNumber: Invalid status value (must be 'active' or 'inactive').";
    //             $lineNumber++;
    //             continue;
    //         }

    //         // Determine status
    //         $status = strtolower($data[2]) === 'active' ? 1 : 0;

    //         // Create the product
    //         Product::create([
    //             'name' => $data[0],
    //             'date' => $data[1],
    //             'status' => $status,
    //             // Add more fields as needed
    //         ]);

    //         $lineNumber++;
    //     }

    //     if (!empty($errors)) {
    //         // Redirect back with error messages
    //         return redirect()->back()->withErrors($errors);
    //     }

    //     return redirect()->back()->with('success', 'CSV file imported successfully.');
    // }

    // public function import(Request $request)
    // {
    //     $file = $request->file('file');
    //     $fileContents = file($file->getPathname());
    //     foreach ($fileContents as $line) {
    //         $data = str_getcsv($line);
    //         if($data[2] == 'active'){
    //             $status = 1;
    //         }else{
    //             $status = 0;
    //          }
    //         Product::create([
    //             'name' => $data[0],
    //             'date' => $data[1],
    //             'status' => $status,
    //             // Add more fields as needed
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'CSV file imported successfully.');
    // }
    public function import(Request $request)
    {
        // Validate the file
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Ensure it's a CSV or TXT file
        ]);

        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        $headerSkipped = false;
        $errors = [];
        $lineNumber = 1;

        $headers = str_getcsv($fileContents[0]);
        if ($headers[0] != 'id') {
            return redirect()->back()->withErrors($headers[0] . ' field not metch with our database');
        }
        if ($headers[1] != 'name') {
            return redirect()->back()->withErrors($headers[1] . ' name not metch with our database');
        }
        if ($headers[2] != 'date') {
            return redirect()->back()->withErrors($headers[2] . ' date not metch with our database');
        }
        if ($headers[3] != 'status') {
            return redirect()->back()->withErrors($headers[2] . ' status not metch with our database');
        }
        foreach ($fileContents as $line) {
            if (!$headerSkipped) {
                $headerSkipped = true; // Skip the first line (header)
                $lineNumber++;
                continue;
            }

            $data = str_getcsv($line);
            //dd($headerSkipped);
            //dd($data);

            // Check if the row has the correct number of columns
            if (count($data) < 3) {
                $errors[] = "Line $lineNumber: Missing required fields.";
                $lineNumber++;
                continue;
            }
            // dd($data[2]);
            // Validate and format the date
            try {
                $formattedDate = \Carbon\Carbon::parse($data[2])->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                dd($e->getMessage());
                $errors[] = "Line $lineNumber: Invalid date format.";
                $lineNumber++;
                continue;
            }

            // Determine the status
            $status = strtolower($data[2]) === 'active' ? 1 : 0;

            // Insert data into the database
            Product::create([
                'name' => $data[1],
                'date' => $formattedDate,
                'status' => $status,
            ]);

            $lineNumber++;
        }

        if (!empty($errors)) {
            // Return errors to the user
            return redirect()->back()->withErrors($errors);
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
        fputcsv($handle, ['name', 'date', 'status']); // Add more headers as needed

        foreach ($products as $product) {
            fputcsv($handle, [$product->name, $product->date, $product->status]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
        //return Excel::download(new File($csvFileName));
        // Excel::class()->export($csvFileName());
    }

    public function exportJoinedTables()
    {
        // return Excel::download(new JoinedTablesExport, 'joined-tables.xlsx');

        $products = DB::table('datfilter')
        
            ->join('register', 'datfilter.id', '=', 'register.datfilter_id')
            ->select(
                'datfilter.name as datfilter_name',
                'datfilter.date',
                'datfilter.status',
                 'register.name as register_name',
                'register.datfilter_id as id',
               // 'datfilter.name as datfilter_name' // Joining data from the second table
            )
         //   ->select('datfilter.name', 'datfilter.date', 'datfilter.status', 'datfilter.datfilter_id as id')

            ->get();
            
            //dd($products);

        $csvFileName = 'datfilter_with_registers.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        // Open output stream
        $handle = fopen('php://output', 'w');

        // Write CSV headers
        fputcsv($handle, ['Register Name', 'Date', 'Status']); // Add headers for joined fields

        // Write data rows
        foreach ($products as $product) {
            //dd($product->status);

            if($product->status==1){
                $product->status = 'Active';
            }else{
                $product->status = 'Inactive';
            }

            fputcsv($handle, [
                $product->datfilter_name,
                $product->register_name,
                $product->date,
                $product->status,
                $product->id,
               // dd($product->name),
                //$product->register->datfilter_id,
            ]);
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
