<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceCharge;
use App\Models\InvoiceMerchantFee;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\StoreDetail;
use App\Models\PaymentDetail;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
class AccountingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        
         $clients = Client::with('company','user','store_details','payment_details')->where('status','=','Completed')->get();
         $companies = Company::all();
         return view('accounting.client',compact('clients','companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        PaymentDetail::create($request->post());

        return redirect()->route('accounting.client.index')->with('success', 'Payment has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
            $company = PaymentDetail::find($id);
            $company->delete();

            return redirect()->route('accounting.client.index')->with('success', 'Payment Detail has been deleted successfully.');
        

    }
    
    public function getPendingInvoices()
    {
        //
        
        $invoice = Invoice::with('user')->where('status',null)->get();
        foreach($invoice as $key => $inv){
          $order = Order::with('store')->where('id','=',$inv->order_id)->first();
        if($order->store){
                 $invoice[$key]["store"]= $order->store;
                 $invoice[$key]["client"]= Client::where('id','=',$order->store->id)->first();
            }
        }
        
         return view('accounting.pending_invoice',compact('invoice'));
    }
    public function getConfirmedInvoices()
    {
        //
        
        
        $invoice = Invoice::with('user')->where('status','Confirmed')->get();
        foreach($invoice as $key => $inv){
          $order = Order::with('store')->where('id','=',$inv->order_id)->first();
        if($order->store){
                 $invoice[$key]["store"]= $order->store;
                 $invoice[$key]["client"]= Client::where('id','=',$order->store->id)->first();
            }
        }
         return view('accounting.confirmed_invoice',compact('invoice'));
    }
    public function getClientPaymentsByDate()
    {
        //
        
        
         $clients = Client::with('company','user','store_details','payment_details')->where('status','=','Completed')->get();
         $companies = Company::all();
         return view('accounting.confirmed_invoice',compact('clients','companies'));
    }

    // functions for the approved po

    public function getApprovedPurchasedOrder(){
         $orders = Order::with('supplier','approved')->where('status','=','Approved')->orderBy('id','desc')->get();
         foreach($orders as $order){
            $order_details = OrderDetails::with('product')->where('order_id','=',$order->id)->get();
            $order["order_details"] = $order_details;
            $order["item_count"] = $order_details->count();
         }
         
         
        return view('accounting.approved_po',compact('orders'));
    }
    public function getPOPdf($id){
        $order = Order::with('supplier')->where('id','=',$id)->first();
        $order_details=OrderDetails::with('product')->where('order_id','=',$order->id)->get();
        
        
        return view('accounting.pdf',compact('order','order_details'));
        
    }
    public function getInvoicePdf($id){

        $invoice = Invoice::where('order_id',$id)->first();
     
        $order = Order::with('store')->where('id','=',$invoice->order_id)->first();
        $order_details=OrderDetails::with('product')->where('order_id','=',$invoice->order_id)->get();

        $order = Order::with('store')->where('id','=',$invoice->order_id)->first();
        $order_details=OrderDetails::with('product')->where('order_id','=',$invoice->order_id)->get();
        if($order->store){
                 $order["client"]= Client::where('id','=',$order->store->id)->first();
            }

        $invoice_charge = InvoiceCharge::where('invoice_id',$invoice->id)->get();
        $invoice_fee = InvoiceMerchantFee::where('invoice_id',$invoice->id)->get();
        
        return view('accounting.invoice_pdf',compact('order','order_details','invoice','invoice_charge','invoice_fee'));
        
        
    }
    public function editInvoice($id)
    {
         $order = Order::where('id',$id)->first();
        $invoice = Invoice::where('order_id',$id)->first();
       
        if(empty($invoice)){
            
            $data1 = array('status'=>'Invoice Created');
            $order->update($data1);

            $data=array('order_id' => $id,'added_by'=> Auth::user()->id);
            Invoice::create($data);
            $invoice = Invoice::latest()->first();

            
        }        

        $order = Order::with('store')->where('id','=',$invoice->order_id)->first();
        $order_details=OrderDetails::with('product')->where('order_id','=',$invoice->order_id)->get();
        if($order->store){
                 $order["client"]= Client::where('id','=',$order->store->id)->first();
            }

        $invoice_charge = InvoiceCharge::where('invoice_id',$invoice->id)->get();
        $invoice_fee = InvoiceMerchantFee::where('invoice_id',$invoice->id)->get();
        //$stores = StoreDetail::with('client')->orderBy('id','desc')->get();

       /* $products = $stores->map(function ($product) {
            return ['id' => $product->id, 'text' => $product->platform.' - '.$product->name.' -('.$product->client->lastname.', '.$product->client->firstname.')'];
        })->toArray();
        */
        return view('accounting.update',compact('order','order_details','invoice','invoice_charge','invoice_fee'));
    }

   
     public function updateOrder(Request $request, $id)
    {   
       
        $order = Order::where('id',$id)->first();
        
        if(!empty($order)){
            $data = $request->post();
            if($request->post('status')== 'Approved'){
                $data["approved_by"] = Auth::user()->id;
            }else{
                unset($data["store_id"]);
            }
            $order->update($data);
        }        

        return redirect()->back()->with('success', 'Purchase Order Details has been updated successfully.');
    }
    public function updateInvoice(Request $request, $id)
    {   
       
        $invoice = Invoice::where('id',$id)->first();
          $data = $request->post();
        /*if(!empty($invoice)){
          
            if($request->post('status')== 'Approved'){
                $data["approved_by"] = Auth::user()->id;
            }else{
                unset($data["store_id"]);
            }
            $invoice->update($data);
        } */       
        $invoice->update($data);
        return redirect()->back()->with('success', 'Invoice Details has been updated successfully.');
    }


    //charge
     public function storeCharge(Request $request)
    {
        //
        InvoiceCharge::create($request->post());

        return redirect()->back();
    }
    public function destroyCharge($id)
    {

            $company = InvoiceCharge::find($id);
            $company->delete();

            return redirect()->back();
        

    }
    //merchant fees
     public function storeFee(Request $request)
    {
        //
        InvoiceMerchantFee::create($request->post());

        return redirect()->back();
    }
    public function destroyFee($id)
    {

            $company = InvoiceMerchantFee::find($id);
            $company->delete();

            return redirect()->back();
        

    }
    

}
