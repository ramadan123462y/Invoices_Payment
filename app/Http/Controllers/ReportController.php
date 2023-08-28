<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {


        return view('reports.invoices_reports');
    }
    public function resut_data(Request $request)
    {
        $details = [];
        if ($request->rdio == 1) {
            if ($request->type && $request->start_at == '' && $request->end_at == '') {

                $details =  DB::table('invoices')->where('Value_Status', $request->type)->get();
                return view('reports.invoices_reports', compact('details'));
            }
            $details = DB::table('invoices')->where('Value_Status', $request->type)->whereBetween('invoice_Date', [$request->start_at, $request->end_at])->get();
            return view('reports.invoices_reports', compact('details'));
        } else {
            $details =  DB::table('invoices')->where('invoice_number', $request->invoice_number)->get();
            return view('reports.invoices_reports', compact('details'));
        }
    }
}
