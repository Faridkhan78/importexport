<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Emport and Import CSV files
Route::get('/importExportView', [ExcelController::class, 'index'])->name('importExportView');
Route::post('/import', [ExcelController::class, 'import'])->name('import');
Route::post('/export', [ExcelController::class, 'export'])->name('export');


// Generate PDF files
Route::get('/pdfgenrate', function () {
    return view('pdfgenrate');
});

Route::get('/exportcp', function () {
    return view('exportcp');
});

//Route::post('/generate-pdf', [PdfController::class, 'generatePdf'])->name('generate-pdf');

Route::get('/download-pdf', function () {
    $filePath = public_path('sample.pdf'); // Path to the PDF file
    return response()->download($filePath, 'SampleFile.pdf');
})->name('download-pdf');

// export join two tables
Route::get('/export-joined-tables', [ExcelController::class, 'exportJoinedTables'])->name('exportJoinedTables');


// ProductController  Categories,Products and Packages

Route::get('/fetchCat-data', [ProductController::class, 'fetchCategoryData']);
Route::get('/fetchProCat-data', [ProductController::class, 'fetchProCatData']);
Route::get('/fetchalldata-data', [ProductController::class, 'fetchalldata']);



// EmportCat and ImportCat CSV files
Route::get('/indexCatView', [ProductController::class, 'indexCat'])->name('indexCatView');
Route::post('/importCat', [ProductController::class, 'importCat'])->name('importCat');
Route::post('/exportCat', [ProductController::class, 'exportCat'])->name('exportCat');

Route::get('/export-three-tables', [ProductController::class, 'exportThreeTables'])->name('exportThreeTables');