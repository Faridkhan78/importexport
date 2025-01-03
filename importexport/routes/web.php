<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ExcelController;

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
