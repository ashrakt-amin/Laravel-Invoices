<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $all = Invoices::count();
        $paid = Invoices::where('value_status', 1)->count();
        $unpaid = Invoices::where('value_status', 0)->count();
        $partial = Invoices::where('value_status', 2)->count();
        
        if($paid == 0){
            $npaid = 0 ;
        }
        else{
            $npaid = round($paid/ $all*100);
        }


        if($unpaid == 0){
            $nunpaid = 0 ;
        }
        else{
            $nunpaid = round($unpaid/ $all*100);
        }

        if($partial == 0){
            $npartial = 0 ;
        }
        else{
            $npartial = round($partial/ $all*100);
        }

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['paid', 'partial', 'unpaid'])
            ->datasets([
                [
                    'backgroundColor' => ['#90B77D', '#FFCB42','#FA9494'],
                    'hoverBackgroundColor' => ['#90B77D', '#FFCB42','#FA9494'],
                    'data' => [$npaid, $npartial,$nunpaid]
                ]
            ])
            ->options([]);

            $chart = app()->chartjs
        ->name('pieChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['paid', 'partial', 'unpaid'])
            ->datasets([
                [
                    "label" => "paid",
                    'backgroundColor' => ['#90B77D'],
                    'data' => [$npaid]
                ],
                [
                    "label" => "partial",
                    'backgroundColor' => ['#FFCB42'],
                    'data' => [$npartial]
                ],
                [
                    "label" => "unpaid",
                    'backgroundColor' => ['#FA9494'],
                    'data' => [$nunpaid]
                ],
            ])
            ->options([]);


        return view('index', compact('chartjs','chart'));
    }
}
