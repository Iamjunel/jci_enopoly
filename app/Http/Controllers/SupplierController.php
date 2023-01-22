<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier = Supplier::with('user')->get();
        return view('supplier.supplier',compact('supplier'));

        
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
        Supplier::create($request->post());

        return redirect()->back()->with('success', 'Client has been created successfully.');
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

        $supplier = Supplier::where('id',$id)->first();
        
        if(!empty($supplier)){
            $supplier->update($request->post());
        }        
        if(isset($request->status) && ($request->status == 'Valid' || $request->status == 'Invalid')){
             return redirect()->back()->with('success', 'Supplier has been moved successfully.');
        }else{
             return redirect()->back()->with('success', 'Supplier has been updated successfully.');
        } 
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $supplier = Supplier::find($id);
            $supplier->delete();

            return redirect()->back()->with('success', 'Supplier has been deleted successfully.');
        
    }

    public function supplier_report()
    {
        //
         $date_from = date('Y-m-d', strtotime("Monday This Week"));
         $date_to = date('Y-m-d', strtotime("Sunday This Week"));
         $status = 'Uncheck';

        $supplier = Supplier::with('user')->whereDate('created_at','>=',$date_from)->whereDate('created_at','<=',$date_to)->get();
        return view('supplier.supplier-report', compact('supplier','date_from','date_to'));
    }

    public function supplier_report_with_date(Request $request)
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

        $supplier = Supplier::with('user')->whereDate('created_at','>=',$date_from)->whereDate('created_at','<=',$date_to)->get();
        return view('supplier.supplier-report', compact('supplier','date_from','date_to'));
    }
}
