<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\StoreDetail;
use App\Models\Company;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::with('company','user','store_details')->get();
        $companies = Company::all();
        return view('clients.client',compact('clients','companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $companies = Company::all();
        return view('clients.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $client_id = Client::create($request->post())->id;
        if($request->post('store') != null){
            foreach ($request->post('store') as $value) {
               $store = array();
               $store["platform"] = $value["platform"];
               $store["name"] = $value["store_name"];
               $store["link"] = $value["store_line"];
               $store["username"] = $value["store_username"];
               $store["password"] = $value["store_password"];
               $store["client_id"] = $client_id;
               $store["added_by"] = $request->post('added_by');
               
               StoreDetail::create($store);
            }
        }

        //
        //Client::create($request->post());



        //return redirect()->route('client_corr.client.index')->with('success', 'Client has been created successfully.');
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
        $client = Client::with('company','user','store_details')->where('id',$id)->first();
        
         $companies = Company::all();
        return view('clients.edit', compact('client','companies'));
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
       
        $client = Client::where('id',$id)->first();
        
        if(!empty($client)){
            if($request->post('store') != null){
            $company = StoreDetail::where('client_id','=',$id)->get();
            $company->each->delete();
            
            foreach ($request->post('store') as $value) {
               if($value["platform"] !=""){
                    $store = array();
                    $store["platform"] = $value["platform"];
                    $store["name"] = $value["store_name"];
                    $store["link"] = $value["store_line"];
                    $store["username"] = $value["store_username"];
                    $store["password"] = $value["store_password"];
                    $store["client_id"] = $id;
                    $store["added_by"] = $request->post('added_by');
                    
                    StoreDetail::create($store);
               } 
               
            }
        }


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

    public function client_report()
    {
        //

       // if($date_from == null && $date_to == null){
            $date_from = date('Y-m-d', strtotime("Monday This Week"));
            $date_to = date('Y-m-d', strtotime("Sunday This Week"));
            $status = 'Incomplete';
        //}
       // var_dump($date_from);
        $clients = Client::with('company','user')->whereDate('created_at','>=',$date_from)->whereDate('created_at','<=',$date_to)->where('status','=','Incomplete')->get();


        $companies = Company::all();
        return view('clients.client-report', compact('clients', 'companies','date_from','date_to','status'));
    }
    public function client_report_with_date(Request $request)
    {
        //
        $date_from = "";
        $date_to = "";
        $status ="";
        if($request->date_from == null && $request->$date_to == null){
            $date_from = date('Y-m-d', strtotime("Monday This Week"));
            $date_to = date('Y-m-d', strtotime("Sunday This Week"));
            $status = "Incomplete";
        }else{
            $date_from = $request->date_from;
            $date_to = $request->date_to;
            $status = $request->status;
        }

        //var_dump($date_from);die;
       
        $clients = Client::with('company','user')->whereDate('created_at','>=',$date_from)->whereDate('created_at','<=',$date_to)->where('status','=',$status)->get();


        $companies = Company::all();
        return view('clients.client-report', compact('clients', 'companies','date_from','date_to','status'));
    }
}
