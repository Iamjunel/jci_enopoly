<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Company;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\OrderDetails;
use App\Models\Announcement;
use App\Models\StoreDetail;
use Carbon\Carbon;
class ClientCorrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();

        $daily_client_count_user   = $client->where('created_at', '>=', date('Y-m-d').' 00:00:00')->where('added_by','=',Auth::user()->id)->count(); 
        $daily_client_count        = $client->where('created_at', '>=', date('Y-m-d').' 00:00:00')->count(); 
        $weekly_client_count       = $client->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthly_client_count      = $client->whereMonth('created_at', Carbon::now()->month)->count();
        $yearly_client_count       = $client->whereYear('created_at', Carbon::now()->year)->count();
        $clients_data              = $client->with('company','user')->where('status','=','Incomplete')->orderBy('created_at', 'desc')->get();
        $purchased_total           = Order::with('supplier','user')->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status','=','Approved')->get()->sum('total');
        $pending_po                = Order::with('supplier','user')->where('status','=','Pending')->take(5)->orderBy('created_at', 'desc')->get();
        $client_array = array();
        $client_array["clients_data"] = $clients_data;
        $client_array["daily_client"] = $daily_client_count;
        $client_array["weekly_client"] = $weekly_client_count;
        $client_array["monthly_client"] = $monthly_client_count;
        $client_array["yearly_client"] = $yearly_client_count;
        $client_array["daily_client_user"] = $daily_client_count_user;
         $client_array["purchased_total"] = $purchased_total;
        
        
        $announcement = Announcement::with('user')->orderBy('id','desc')->take(50)->get();

        return view('clients.client_dashboard', compact('client_array','announcement','pending_po'));

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
        $client = Client::where('id',$id)->first();
        
        if(!empty($client)){
            $client->update($request->post());
        }        

        return redirect()->route('client_corr.client.index')->with('success', 'Client has been updated successfully.');
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

    public function getPendingPurchaseOrder(){
         $orders = Order::with('supplier','user')->where('status','=','Pending')->orderBy('id','desc')->get();
         foreach($orders as $order){
            $order_details = OrderDetails::with('product')->where('order_id','=',$order->id)->get();
            $order["order_details"] = $order_details;
            $order["item_count"] = $order_details->count();
         }
         
         
        return view('clients.pending_po',compact('orders'));
    }
    public function storeOrderDetails(Request $request)
    {
        
         OrderDetails::create($request->post());
       return redirect()->back();
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
        
        return view('clients.update',compact('order','products','order_details','stores'));
    }
    public function getApprovedPurchasedOrder(){
         $orders = Order::with('supplier','approved')->where('status','=','Approved')->orderBy('id','desc')->get();
         foreach($orders as $order){
            $order_details = OrderDetails::with('product')->where('order_id','=',$order->id)->get();
            
            $order["order_details"] = $order_details;
            $order["item_count"] = $order_details->count();
         }
         
         
        return view('clients.approved_po',compact('orders'));
    }
    public function getPOPdf($id){
         $order = Order::with('supplier','store')->where('id','=',$id)->first();
        $order_details=OrderDetails::with('product')->where('order_id','=',$order->id)->get();
        if($order->store){
                 $order["client"]= Client::where('id','=',$order->store->id)->first();
            }
        
        return view('clients.pdf',compact('order','order_details'));
        
    }
    public function destroyItem($id)
    {
        //
        $order_details = OrderDetails::find($id);
        $order_details->delete();
        return redirect()->route('purchaser_product.create');
    }
     public function updateOrder(Request $request, $id)
    {   
        $order = Order::where('id',$id)->first();
        
        if(!empty($order)){
            $data = $request->post();
            //if($request->post('status')== 'Approved'){
           //     $data["approved_by"] = Auth::user()->id;
            //}else{
           //     unset($data["store_id"]);
            //}
            $order->update($data);
        }        

        return redirect()->back()->with('success', 'Purchase Order Details has been updated successfully.');
    }
}
