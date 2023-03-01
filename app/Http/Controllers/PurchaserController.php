<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\OrderDetails;
class PurchaserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::with('user')->where('qa_status','=','Good To Order')->orderBy('id','desc')->get();
        return view('purchaser.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $last_entry = Order::latest()->first();
        $order = Order::with('supplier')->where('id','=',$last_entry->id)->first();
        $order_details=OrderDetails::with('product')->where('order_id','=',$order->id)->get();
        $products = Product::with('user')->where('qa_status','=','Good To Order')->orderBy('id','desc')->get();
        $products = $products->map(function ($product) {
            return ['id' => $product->id, 'text' => $product->asin.'-'.$product->amazon_title];
        })->toArray();
        
        return view('purchaser.create',compact('order','products','order_details'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         Order::create($request->post());
        return redirect()->route('purchaser_product.create');
    }

    public function storeOrderDetails(Request $request)
    {
        
         OrderDetails::create($request->post());
       return redirect()->back();
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
        $order = Order::with('supplier')->where('id','=',$id)->first();
        $order_details=OrderDetails::with('product')->where('order_id','=',$order->id)->get();
        $products = Product::with('user')->where('qa_status','=','Good To Order')->orderBy('id','desc')->get();
        $products = $products->map(function ($product) {
            return ['id' => $product->id, 'text' => $product->asin.'-'.$product->amazon_title];
        })->toArray();
        
        return view('purchaser.update',compact('order','products','order_details'));
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
        $order = Order::where('id',$id)->first();
        
        if(!empty($order)){
            $order->update($request->post());
        }        

        return redirect()->back()->with('success', 'Purchase Order Details has been updated successfully.');
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
    }
    public function destroyItem($id)
    {
        //
        $order_details = OrderDetails::find($id);
        $order_details->delete();
        return redirect()->route('purchaser_product.create');
    }
    public function getPendingPurchaseOrder(){
         $orders = Order::with('supplier','user')->where('status','=','Pending')->orderBy('id','desc')->get();
         foreach($orders as $order){
            $order_details = OrderDetails::with('product')->where('order_id','=',$order->id)->get();
            $order["order_details"] = $order_details;
            $order["item_count"] = $order_details->count();
         }
         
         $supplier = Supplier::where('status','=','Approved')->orderBy('lastname','asc')->get();
        return view('purchaser.pending_po',compact('orders','supplier'));
    }
    public function getApprovedPurchasedOrder(){
         $orders = Order::with('supplier','user')->where('status','=','Approved')->orderBy('id','desc')->get();
         foreach($orders as $order){
            $order_details = OrderDetails::with('product')->where('order_id','=',$order->id)->get();
            $order["order_details"] = $order_details;
            $order["item_count"] = $order_details->count();
         }
         
         $supplier = Supplier::where('status','=','Approved')->orderBy('lastname','asc')->get();
        return view('purchaser.approved_po',compact('orders','supplier'));
    }
    public function getPOPdf($id){
         $order = Order::with('supplier')->where('id','=',$id)->first();
        $order_details=OrderDetails::with('product')->where('order_id','=',$order->id)->get();
        
        
        return view('purchaser.pdf',compact('order','order_details'));
        
    }
}
