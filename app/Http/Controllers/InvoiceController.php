<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::get();


        return view('Invoice.invoices', compact('invoices'));
    }
    public function create_invoice()
    {


        return view('Invoice.add_invoice');
    }
    public function store_invoice(InvoiceRequest $request)
    {

        Invoice::create([

            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,

            'Value_Status' => 0,
            'note' => $request->note,

        ]);

        //محتاج تفعيل ------

        // $user = User::find(1);
        // Mail::to($user)->send(new InvoiceMail());
        //------------------




        return redirect()->back()->with('msg_invoice', "تم حفظ الفاتوره بنجاح");
    }
    public function edit_invoice($id)
    {
        $invoices = Invoice::find($id);
        $sections = Section::get();
        return view('Invoice.edit_invoices', compact('invoices', 'sections'));
    }
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }
    public function update_invoice(InvoiceRequest $request, $id)
    {

        Invoice::find($id)->update([

            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Value_Status' => 0,
            'note' => $request->note,
        ]);
        return redirect('invoice')->with('msg_invoice', "تم تحديث الفاتوره بنجاح");
    }
    public function delete_invoice($id)
    {

        Invoice::find($id)->delete();
        return redirect('invoice')->with('msg_invoice', "تم حذف الفاتوره بنجاح");
    }
    public function update_status(Request $request)
    {

        Invoice::find($request->model_id)->update([

            'Value_Status' => $request->model_status,

        ]);
        return redirect('invoice')->with('msg_invoice', "تم تحديث حاله الدفع الفاتوره بنجاح");
    }
    public function soft_delete($id)
    {

        Invoice::find($id)->delete();
        return redirect('invoice')->with('msg_invoice', "تم  نقل الي الارشيف بنجاح");
    }
    public function archive_invoices()
    {

        $invoices =  Invoice::onlyTrashed()->get();
        return view('Invoice.archive_invoice', compact('invoices'));
    }
    public function force_delete(Request $request)
    {
        Invoice::withTrashed()->find($request->invoice_id)->forceDelete();
        return redirect()->back()->with('msg_invoice', "تم حذف افاتوره من الارشيف  بنجاح");
    }
    public function restore_invoice(Request $request)
    {
        Invoice::withTrashed()
            ->find($request->invoice_id)
            ->restore();

        return redirect()->back()->with('msg_invoice', "تم استرجاج افاتوره من الارشيف  بنجاح");
    }
    public function paid_invoice()
    {

        $invoices = Invoice::where('Value_Status', 2)->get();
        return view('Invoice.paid_invoices', compact('invoices'));
    }
    public function unpaid_invoice()
    {

        $invoices = Invoice::where('Value_Status', 0)->paginate(5);
        return view('Invoice.unpaid', compact('invoices'));
    }
    public function invoices_Partial()
    {

        $invoices = Invoice::where('Value_Status', 1)->paginate(5);
        return view('Invoice.invoices_Partial', compact('invoices'));
    }
    public function print_invoice($id)
    {
        $invoices = Invoice::find($id);
        return view('Invoice.Print_invoice', compact('invoices'));
    }
}
