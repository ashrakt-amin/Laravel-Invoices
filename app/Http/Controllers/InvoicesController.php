<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\invoice;
use App\Models\Product;
use App\Models\Section;
use App\Models\Invoices;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Models\InvoiceAttachment;
use App\Notifications\NewInvoice;
use App\Notifications\createInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class InvoicesController extends Controller
{

    public function index()
    {
        $invoices = Invoices::with('section')->get();

        return view('invoices.index', compact('invoices'));
    }



    public function create()
    {
        $sections = Section::all();
        return view('invoices.create', compact('sections'));
    }


    public function store(Request $request)
    {
        Invoices::create([
            'invoice_number'    => $request->invoice_number,
            'invoice_date'      => $request->invoice_date,
            'due_date'          => $request->due_date,
            'product'           => $request->product,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'section_id'        => $request->section_id,
            'discount'          => $request->discount,
            'rate_vat'          => $request->rate_vat,
            'value_vat'         => $request->value_vat,
            'total'             => $request->total,
            'status'            => "unpaid",
            'value_status'      => 0,
            'note'              => $request->note,
            'section_id'        => $request->section
        ]);


        $invoice_id = Invoices::latest()->first()->id;

        InvoiceDetail::create([
            'number' => $request->invoice_number,
            'user'   => Auth::user()->name,
            'section' => $request->section,
            'product' => $request->product,
            'status' => "unpaid",
            'value_status' => 0,
            'note' => $request->note,
            'invoice_id' => $invoice_id,

        ]);
        if ($request->file('pic')) {
            $name = $request->file('pic')->getClientOriginalName();
            $path = $request->file('pic')->storeAs('InvoiceAttachments', $name, 'ashrakt');

        InvoiceAttachment::create([
                'user' => Auth::user()->name,
                'file_name' => $path,
                'invoice_number' => $request->invoice_number,
                'invoice_id' => $invoice_id,


            ]);
          
        }


        $invoice = Invoices::latest()->first();


        $users = User::where('id', '!=', auth::user()->id)->get();
        Notification::send($users, new NewInvoice($invoice));


        return redirect('/dashboard/invoices');
    }



    public function show($id)
    {
        $invoices = Invoices::findOrFail($id)->first();
        return view('invoices.statusUpdate', compact('invoices'));
    }






    public function statusUpdate(Request $request, $id)
    {
        $invoice = Invoices::findOrFail($id);
        // return $invoice->id;
        // return $request;

        if ($request->status == 'paid') {
            $invoice->update([
                'status' => $request->status,
                "value_status" => 1,
                "Payment_Date" => $request->Payment_Date,
            ]);

            InvoiceDetail::create([
                'number' => $request->invoice_number,
                'user' => Auth::user()->name,
                'section' => $request->Section,
                'product' => $request->product,
                'status' => $request->status,
                'value_status' => 1,
                'note' => $request->note,
                'invoice_id' => $invoice->id,

            ]);
        } elseif ($request->status == 'unpaid') {
            $invoice->update([
                'status' => $request->status,
                "value_status" => 0,
                "Payment_Date" => $request->Payment_Date,
            ]);

            InvoiceDetail::create([
                'number' => $request->invoice_number,
                'user' => Auth::user()->name,
                'section' => $request->Section,
                'product' => $request->product,
                'status' => $request->status,
                'value_status' => 0,
                'note' => $request->note,
                'invoice_id' => $invoice->id,

            ]);
        } else {
            $invoice->update([
                'status' => $request->status,
                "value_status" => 2,
                "Payment_Date" => $request->Payment_Date,
            ]);

            InvoiceDetail::create([
                'number' => $request->invoice_number,
                'user' => Auth::user()->name,
                'section' => $request->Section,
                'product' => $request->product,
                'status' => $request->status,
                'value_status' => 2,
                'note' => $request->note,
                'invoice_id' => $invoice->id,

            ]);
        }

        return redirect('/dashboard/invoices');
    }



    public function edit($id)
    {
        $invoices = Invoices::with('section')->where('id', $id)->first();
        $sections = Section::all();
        return view('invoices.edit', compact('invoices', 'sections'));
    }



    public function update(Request $request, $id)
    {
        // return $request;
        //  return $invoices ;
        Invoices::findOrFail($id)->update([
            'invoice_number'    => $request->invoice_number,
            'invoice_date'      => $request->invoice_date,
            'due_date'          => $request->due_date,
            'product'           => $request->product,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'section_id'        => $request->section_id,
            'discount'          => $request->discount,
            'rate_vat'          => $request->rate_vat,
            'value_vat'         => $request->value_vat,
            'total'             => $request->total,
            'status'            => "unpaid",
            'value_status'      => 0,
            'note'              => $request->note,
            'section_id'        => $request->section
        ]);


        $invoice_id = Invoices::latest()->first()->id;
        // return $invoice_id;
                if( InvoiceDetail::where('invoice_id', $invoice_id) === null){
                    InvoiceDetail::create([
                        'number' => $request->invoice_number,
                        'user'   => Auth::user()->name,
                        'section' => $request->section,
                        'product' => $request->product,
                        'status' => "unpaid",
                        'value_status' => 0,
                        'note' => $request->note,
                        'invoice_id' => $invoice_id,
            
                    ]);
                }else{
                    InvoiceDetail::where('invoice_id', $invoice_id)->first()->update([
                'number' => $request->invoice_number,
                'user'   => Auth::user()->name,
                'section' => $request->section,
                'product' => $request->product,
                'status' => "unpaid",
                'value_status' => 0,
                'note' => $request->note,
                'invoice_id' => $invoice_id,
    
            ]);

        }
    
           
        
        if ($request->file('pic')) {
            $name = $request->file('pic')->getClientOriginalName();
            $path = $request->file('pic')->storeAs('InvoiceAttachments', $name, 'ashrakt');

           if(InvoiceAttachment::where('invoice_id', $invoice_id)->first() == null){
            InvoiceAttachment::create([
                'user' => Auth::user()->name,
                'file_name' => $path,
                'invoice_number' => $request->invoice_number,
                'invoice_id' => $invoice_id,

            ]);
        }else{
            InvoiceAttachment::where('invoice_id', $invoice_id)->first()->update([
                'user' => Auth::user()->name,
                'file_name' => $path,
                'invoice_number' => $request->invoice_number,
                'invoice_id' => $invoice_id,


            ]);

        }
        
    }


        return  redirect('dashboard/invoices');
    }

    
    public function destroy($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $oldFile = InvoiceAttachment::where('invoice_id', $id)->first();


        if ($oldFile != null) {
                    foreach ($oldFile as $file) {
                        Storage::disk('ashrakt')->delete($file->file_name);
                        $invoices->forceDelete();
                        session()->flash('delete_invoice');
                    }
                }

                    $invoices->forceDelete();
                    session()->flash('delete_invoice');
                    
                    return redirect('/dashboard/invoices');
        

        
    }


    public function getProducts($id)
    {
        $products = Product::where('section_id', "=", $id)->pluck('name', 'id');
        return json_encode($products);
    }

    public function invoicePrint($id)
    {
        $invoices = Invoices::with('section')->findOrFail($id);
        $product = Product::where('id', $invoices->product)->first();
        //    return $product;
        return view('invoices.print', compact('invoices', 'product'));
    }

    public function markAzRecord()
    {
        $userUnreadNotification = auth()->user()->unreadNotifications;

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }

    public function unreadNotifications_count()

    {
        return auth()->user()->unreadNotifications->count();
    }

    public function unreadNotifications()

    {
        foreach (auth()->user()->unreadNotifications as $notification) {

            return $notification->data['title'];
        }
    }
}
