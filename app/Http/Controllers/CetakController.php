<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakController extends Controller
{
    public function cetak()
    {
        // return view('print.report');        
        $pdf = Pdf::loadview('print.report')->setPaper('a4','landscape');
        $pdf->download();
    }
}
