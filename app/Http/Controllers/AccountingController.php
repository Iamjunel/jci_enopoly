<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
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
    public function getApprovedPurchaseOrder()
    {
        //
        
        
         $clients = Client::with('company','user','store_details','payment_details')->where('status','=','Completed')->get();
         $companies = Company::all();
         return view('accounting.approve_po',compact('clients','companies'));
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
}
