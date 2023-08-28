<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class DashboardController extends Controller
{
    public function index()
    {

        $invoices_all = Invoice::get()->count();
        $invoices_unpaid = Invoice::where('Value_Status', 0)->get()->count();
        $invoices_part_paid = invoice::where('Value_Status', 1)->count();
        $invoices_paid = invoice::where('Value_Status', 2)->count();

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])

            ->labels(['الفواتير المدفوعه', ' الفواتير الغير مدفوعه', ' الفواتير المدفوعه حزئيا', 'الفواتير المؤرشفه'])
            ->datasets([
                [
                    "label" => ['الفواتير المدفوعه', ' الفواتير الغير مدفوعه', ' الفواتير المدفوعه حزئيا', 'الفواتير المؤرشفه'],
                    'backgroundColor' => ['#008000', '#FF0000', '#FFA500', '#000000'],
                    'hoverBackgroundColor' => ['#008000', '#FF0000', '#FFA500', '#000000'],
                    'data' => [$invoices_paid, $invoices_unpaid, $invoices_part_paid, $invoices_paid]
                ],



            ])
            ->options([]);
        //--------------chartjs2----------------------------------------------------------------------
        $chartjs2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 300])
            ->labels(['الفواتير المدفوعه', ' الفواتير الغير مدفوعه', ' الفواتير المدفوعه حزئيا', 'الفواتير المؤرشفه'])
            ->datasets([
                [
                    'backgroundColor' => ['#008000', '#FF0000', '#FFA500', '#000000'],
                    'hoverBackgroundColor' => ['#008000', '#FF0000', '#FFA500', '#000000'],
                    'data' => [$invoices_paid, $invoices_unpaid, $invoices_part_paid, $invoices_paid]
                ],



            ])
            ->options([]);

        return view('welcome', compact('chartjs', 'chartjs2', 'invoices_all', 'invoices_unpaid', 'invoices_part_paid', 'invoices_paid'));
    }
}
