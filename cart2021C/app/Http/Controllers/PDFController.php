<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use App\Models\myOrder;
use Auth;

class PDFController extends Controller
{
    public function pdfReport()
    {
        $orders = DB::table('my_orders')
        ->select('my_orders.id as oid','my_orders.*')
        ->where('my_orders.userID','=',Auth::id())
        ->get();

        $pdf = PDF::loadView('myPDF', compact('orders'));

        return $pdf->download('OrderReport.pdf');
    }
}
