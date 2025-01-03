<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf()
    {
        // Include the FPDF library
        require_once app_path('Libraries/fpdf.php');

        // Create a new FPDF instance
        $pdf = new \FPDF();
        $pdf->AddPage();

        // Set font and add content
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'PDF Generated from Laravel', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'This is a sample PDF file generated without using additional Laravel packages.', 0, 1);
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Generated at: ' . now(), 0, 1);

        // Output the PDF for download
        $pdf->Output('D', 'GeneratedFile.pdf');
    }
}
