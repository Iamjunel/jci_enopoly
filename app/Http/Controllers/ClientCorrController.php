<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Company;
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

        $client_array = array();
        $client_array["clients_data"] = $clients_data;
        $client_array["daily_client"] = $daily_client_count;
        $client_array["weekly_client"] = $weekly_client_count;
        $client_array["monthly_client"] = $monthly_client_count;
        $client_array["yearly_client"] = $yearly_client_count;
        $client_array["daily_client_user"] = $daily_client_count_user;


        return view('clients.client_dashboard', compact('client_array'));

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

        return redirect()->route('client_corr.dashboard')->with('success', 'Client has been updated successfully.');
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
}
