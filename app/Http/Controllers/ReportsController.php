<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Invoices;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.invoice');
    }

    public function search(Request $request)
    {
        // return $request;

        $radio = $request->radio;
        if ($radio == 1) {
            if ($request->type && $request->start_at == '' && $request->end_at == '') {
                $invoices = Invoices::where('status', "=", $request->type)->get();
                $type = $request->type;
                return view('reports.invoice', compact('type', 'invoices'));
            } else {
                $type = $request->type;
                $start_at = $request->start_at;
                $end_at = $request->end_at;
                $invoices = Invoices::whereBetween('invoice_date', [$start_at, $end_at])->where('status', "=", $request->type)->get();
                $type = $request->type;
                return view('reports.invoice', compact('type', 'start_at', 'end_at', 'invoices'));
            }
        } else {
            $invoices = Invoices::where('invoice_number', "=", $request->number)->get();
            $number = $request->number;
            return view('reports.invoice', compact('number', 'invoices'));
        }
    }


    public function userIndex()
    {
        $sections = Section::all();
        return view('reports.user', compact('sections'));
    }

    public function userSearch(Request $request)
    {
        // return $request;
        $sections = Section::all();


        if ($request->section && $request->product && $request->start_at == '' && $request->end_at == '') {
            $invoices = Invoices::where('section_id', "=", $request->section)
                ->where('product', "=", $request->product)->get();
            // return $invoices;
            $section = $request->section;
            $sn = Section::where('id', "=", $section)->first();
            // return $sn->name;
            $sectionName = $sn->name;

            return view('reports.user', compact('invoices', 'sections', 'section', 'sectionName'));
        } else {
            $section = $request->section;
            $sn = Section::where('id', "=", $section)->first();
            $sectionName = $sn->name;
            $product = $request->product;
            $start_at =date($request->start_at);
            $end_at = date($request->end_at);
            $invoices = Invoices::whereBetween('invoice_date', [$start_at, $end_at])->where('section_id', "=", $request->section)
                ->where('product', "=", $request->product)->get();
            return view('reports.user', compact('sectionName','sections', 'product', 'start_at', 'end_at', 'invoices', 'section'));
        }
    }
}
