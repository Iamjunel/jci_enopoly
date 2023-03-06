<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\StoreDetail;
use App\Models\PaymentDetail;
use App\Models\Company;
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
        
        
         $clients = Client::with('company','user','store_details','payment_details')->where('status','=','Completed')->get();
         $companies = Company::all();
         return view('accounting.pending_invoice',compact('clients','companies'));
    }
    public function getConfirmedInvoices()
    {
        //
        
        
         $clients = Client::with('company','user','store_details','payment_details')->where('status','=','Completed')->get();
         $companies = Company::all();
         return view('accounting.confirmed_invoice',compact('clients','companies'));
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
    public function editOrder($id)
    {
        //
        $order = Order::with('supplier')->where('id','=',$id)->first();
        $order_details=OrderDetails::with('product')->where('order_id','=',$order->id)->get();
        $stores = StoreDetail::with('client')->orderBy('id','desc')->get();

        $products = $stores->map(function ($product) {
            return ['id' => $product->id, 'text' => $product->platform.' - '.$product->name.' -('.$product->client->lastname.', '.$product->client->firstname.')'];
        })->toArray();
        
        return view('accounting.update',compact('order','products','order_details','stores'));
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


}
