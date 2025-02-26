<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function indexCat()
    {
        return view('categoryimportexport');
    }
    // public function importCat111(Request $request)
    // {
    //     // Validate the file
    //     $request->validate([
    //         'file' => 'required|mimes:csv,txt|max:2048', // Ensure it's a CSV or TXT file
    //     ]);

    //     $file = $request->file('file');
    //     $fileContents = file($file->getPathname());
    //     $headerSkipped = false;
    //     $errors = [];
    //     $lineNumber = 1;

    //     $headers = str_getcsv($fileContents[0]);
    //     //dd($headers);
    //     if ($headers[0] != 'category_name') {
    //         return redirect()->back()->withErrors($headers[0] . ' category_name not metch with our database');
    //     }
    //     if ($headers[1] != 'product_name') {
    //         return redirect()->back()->withErrors($headers[1] . ' product_name not metch with our database');
    //     }
    //     if ($headers[2] != 'sku_varient') {
    //         return redirect()->back()->withErrors($headers[2] . ' sku_varient not metch with our database');
    //     }
    //     if ($headers[3] != 'sku_price') {
    //         return redirect()->back()->withErrors($headers[2] . ' sku_price not metch with our database');
    //     }
    //     foreach ($fileContents as $line) {
    //         if (!$headerSkipped) {
    //             $headerSkipped = true; // Skip the first line (header)
    //             $lineNumber++;
    //             continue;
    //         }

    //         $data = str_getcsv($line);
    //         //dd($headerSkipped);
    //         //dd($data);

    //         // Check if the row has the correct number of columns
    //         if (count($data) < 3) {
    //             $errors[] = "Line $lineNumber: Missing required fields.";
    //             $lineNumber++;
    //             continue;
    //         }
    //         // dd($data[3]);
    //         try {
    //             // Insert into category table and get the ID
    //             $categoryId = DB::table('category')->insertGetId([
    //                 'category_name' => $data[0],
    //             ]);

    //             // Insert into product table and get the ID
    //             $productId = DB::table('product')->insertGetId([
    //                 'product_name' => $data[1],
    //                 'category_id' => $categoryId, // Link to category table
    //             ]);
    //             // Insert into package table (linked to product)
    //             DB::table('package')->insert([
    //                 'sku_varient' => $data[2],
    //                 'sku_price' => $data[3],
    //                 'product_id' => $productId, // Link to product table
    //             ]);
    //             // DB::commit(); // Commit Transaction
    //         } catch (\Exception $e) {
    //             // DB::rollBack(); // Rollback if there is an error
    //             return response()->json(['error' => $e->getMessage()], 500);
    //         }
    //         $lineNumber++;
    //     }
    //     if (!empty($errors)) {
    //         // Return errors to the user
    //         return redirect()->back()->withErrors($errors);
    //     }
    //     return redirect()->back()->with('success', 'CSV file imported successfully.');
    // }
    // public function importCat123(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:csv,txt|max:2048', // Ensure it's a CSV or TXT file
    //     ]);

    //     $file = $request->file('file');
    //     $fileContents = file($file->getPathname());
    //     $headerSkipped = false;
    //     $errors = [];
    //     $lineNumber = 1;

    //     $headers = str_getcsv($fileContents[0]);

    //     if ($headers[0] != 'category_name') {
    //         return redirect()->back()->withErrors($headers[0] . ' category_name not match with our database');
    //     }
    //     if ($headers[1] != 'product_name') {
    //         return redirect()->back()->withErrors($headers[1] . ' product_name not match with our database');
    //     }
    //     if ($headers[2] != 'sku_varient') {
    //         return redirect()->back()->withErrors($headers[2] . ' sku_varient not match with our database');
    //     }
    //     if ($headers[3] != 'sku_price') {
    //         return redirect()->back()->withErrors($headers[3] . ' sku_price not match with our database');
    //     }

    //     foreach ($fileContents as $line) {
    //         if (!$headerSkipped) {
    //             $headerSkipped = true; // Skip the first line (header)
    //             $lineNumber++;
    //             continue;
    //         }

    //         $data = str_getcsv($line);

    //         if (count($data) < 4) {
    //             $errors[] = "Line $lineNumber: Missing required fields.";
    //             $lineNumber++;
    //             continue;
    //         }

    //         try {
    //             // Check if category exists
    //             $category = DB::table('category')->where('category_name', $data[0])->first();
    //             // $category = DB::table('category')->where('category_name',$data[0])->with('success','CSV file imported successfully.');
    //             if (!$category) {
    //                 $categoryId = DB::table('category')->insertGetId([
    //                     'category_name' => $data[0],
    //                 ]);
    //             } else {
    //                 $categoryId = $category->id;
    //             }

    //             // Check if product exists under this category
    //             $product = DB::table('product')->where('product_name', $data[1])->where('category_id', $categoryId)->first();
    //             if (!$product) {
    //                 $productId = DB::table('product')->insertGetId([
    //                     'product_name' => $data[1],
    //                     'category_id' => $categoryId,
    //                 ]);
    //             } else {
    //                 $productId = $product->id;
    //             }

    //             // Check if package (sku_varient) exists under this product
    //             $packageExists = DB::table('package')
    //                 ->where('sku_varient', $data[2])
    //                 ->where('product_id', $productId)
    //                 ->exists();

    //             if (!$packageExists) {
    //                 DB::table('package')->insert([
    //                     'sku_varient' => $data[2],
    //                     'sku_price' => $data[3],
    //                     'product_id' => $productId,
    //                 ]);
    //             }
    //         } catch (\Exception $e) {
    //             return response()->json(['error' => $e->getMessage()], 500);
    //         }

    //         $lineNumber++;
    //     }

    //     if (!empty($errors)) {
    //         return redirect()->back()->withErrors($errors);
    //     }

    //     return redirect()->back()->with('success', 'CSV file imported successfully.');
    // }
    public function importCat(Request $request)
    {
        
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Ensure it's a CSV or TXT file
        ]);

        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        $headerSkipped = false;
        $errors = [];
        $lineNumber = 1;

        $headers = str_getcsv($fileContents[0]);

        if ($headers[0] != 'category_name') {
            return redirect()->back()->withErrors(['errors' => 'Column "category_name" does not match.']);
        }
        if ($headers[1] != 'product_name') {
            return redirect()->back()->withErrors(['errors' => 'Column "product_name" does not match.']);
        }
        if ($headers[2] != 'sku_varient') {
            return redirect()->back()->withErrors(['errors' => 'Column "sku_varient" does not match.']);
        }
        if ($headers[3] != 'sku_price') {
            return redirect()->back()->withErrors(['errors' => 'Column "sku_price" does not match.']);
        }

        foreach ($fileContents as $line) {
            if (!$headerSkipped) {
                $headerSkipped = true;
                $lineNumber++;
                continue;
            }

            $data = str_getcsv($line);

            if (count($data) < 4) {
                $errors[] = "Line $lineNumber: Missing required fields.";
                $lineNumber++;
                continue;
            }

            try {

                // Check if category exists
            
                // $category = Category::where('category_name', $data[0])->first();

                  $category = DB::table('category')->where('category_name', $data[0])->first();

                if (!$category) {
                    $categoryId = DB::table('category')->insertGetId([
                        'category_name' => $data[0],
                    ]);
                } else {
                    $categoryId = $category->id;
                }

                // Check if product exists under this category
                $product = DB::table('product')
                    ->where('product_name', $data[1])
                    ->where('category_id', $categoryId)
                    ->first();

                if (!$product) {
                    $productId = DB::table('product')->insertGetId([
                        'product_name' => $data[1],
                        'category_id' => $categoryId,
                    ]);
                } else {
                    $productId = $product->id;
                }

                // Check if SKU variant already exists
                $skuExists = DB::table('package')
                    ->where('sku_varient', $data[2])
                    ->where('product_id', $productId)
                    ->exists();

                if ($skuExists) {
                    $errors[] = "Line $lineNumber: SKU Variant '{$data[2]}' already exists.";
                } else {
                    DB::table('package')->insert([
                        'sku_varient' => $data[2],
                        'sku_price' => $data[3],
                        'product_id' => $productId,
                    ]);
                }
            } catch (\Exception $e) {
                // return redirect()->back()->withErrors("Same data not allowed");
            //    return  $errors[] = "Line $lineNumber: SKU Variant '{$data[2]}' already exists.";
                return redirect()->back()->withErrors("Same data not allowed");
                // return response()->json(['error' => $e->getMessage()], 500);
                // return redirect()->back()->$errors[$e->getCode()];
            }

            $lineNumber++;
        }

        // if (!empty($errors)) {
        //     // return redirect()->back()->withErrors($errors);
        // }
        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
    public function exportCat()
    {
        // dd(1);
        $packages = DB::table('package')->get();
        // dd( $packages);
        $products = DB::table('product')->get();
        // dd( $products);
        $categorys = DB::table('category')->get();
        //   dd($categorys);
        $csvFileName = 'products_export.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['category_name', 'product_name', 'sku_varient', 'sku_price']); // Add more headers as needed

        // foreach ($categorys as $category) {
        //     fputcsv($handle, [$category->category_name]); // Add more fields as needed
        // }
        // foreach ($products as $product) {
        //     fputcsv($handle, [$product->product_name]); // Add more fields as needed
        // }
        // foreach ($packages as $package) {
        //     fputcsv($handle, [$package->sku_varient, $package->sku_price]); // Add more fields as needed
        // }

        // Fetch data using JOINs
        $data = DB::table('package')
            ->join('product', 'package.product_id', '=', 'product.product_id')
            ->join('category', 'product.category_id', '=', 'category.category_id')
            ->select('category.category_name', 'product.product_name', 'package.sku_varient', 'package.sku_price')
            ->get();

        // Loop through data and write to CSV
        foreach ($data as $row) {
            fputcsv($handle, [
                $row->category_name,
                $row->product_name,
                $row->sku_varient,
                $row->sku_price
            ]);
        }

        fclose($handle);
        return Response::make('', 200, $headers);
        //return Excel::download(new File($csvFileName));
        // Excel::class()->export($csvFileName());
    }
    public function exportThreeTables()
    {
        // return Excel::download(new JoinedTablesExport, 'joined-tables.xlsx');

        $packages = DB::table('package as p')
            ->join('product as pr', 'p.product_id', '=', 'pr.product_id')
            ->join('category as c', 'pr.category_id', '=', 'c.category_id')
            ->select('p.*', 'pr.product_name', 'c.category_name')
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
        fputcsv($handle, ['Category Name', 'ProductName', 'Price', 'varient']); // Add headers for joined fields

        // Write data rows
        foreach ($packages as $package) {
            //dd($product->status);

            fputcsv($handle, [
                $package->category_name,
                $package->product_name,
                $package->sku_price,
                $package->sku_varient,
                // dd($product->name),
                //$product->register->datfilter_id,
            ]);
        }
        fclose($handle);
        return Response::make('', 200, $headers);
    }



    public function fetchCategoryData()
    {
        $categories = DB::table('category')->get();
        return response()->json($categories);
    }

    public function fetchProCatData()
    {
        $products = DB::table('product')
            ->join('category', 'product.category_id', '=', 'category.category_id')
            ->select('product.*', 'category.category_name')
            ->get();

        return response()->json($products);
    }

    // public function fetchalldata(){
    //     $packages = DB::table('package')
    //     ->join('package', 'package.product_id', '=', 'product.product_id')
    //     ->join('category', 'product.category_id', '=', 'category.category_id')
    //     ->select('package.*', 'product.product_name', 'category.category_name')
    //     ->get();

    //  return response()->json($packages);

    // }
    public function fetchalldata()
    {
        $packages = DB::table('package as p')
            ->join('product as pr', 'p.product_id', '=', 'pr.product_id')
            ->join('category as c', 'pr.category_id', '=', 'c.category_id')
            ->select('p.*', 'pr.product_name', 'c.category_name')
            ->get();

        return response()->json($packages);
    }
}
