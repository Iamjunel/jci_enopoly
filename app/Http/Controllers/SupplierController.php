<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Announcement;
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
        $supplier = Supplier::with('user')->whereNull('checker_id')->get();
        $announcement = Supplier::with('user')->get();
        return view('supplier.supplier',compact('supplier','announcement'));

        
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
        $rules = array(
            'email' => ['required', 'string', 'email', 'max:255', 'unique:supplier'],
            'website_link' => ['required', 'string', 'min:6', 'unique:supplier'],
            );
 
        $validator = \Validator::make($request->post(), $rules);
    
        if ($validator->fails())
        {  
            $error_message = implode(",",$validator->messages()->all());
            return redirect()->back()->with('failed', "Supplier cannot be added because of this following reasons:\n". $error_message);
        }

        Supplier::create($request->post());

        return redirect()->back()->with('success', 'Supplier has been created successfully.');
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
         $date_from = date('Y-m-d H:i:s', strtotime("Monday This Week"));
         $date_to = date('Y-m-d H:i:s', strtotime("Sunday This Week"));
         $status = 'Uncheck';

        $supplier = Supplier::with('user')->whereDate('created_at','>=',$date_from)->whereDate('created_at','<=',$date_to)->where('status','=',$status)->get();
        $supplier_count = $supplier->count();
        return view('supplier.supplier-report', compact('supplier','date_from','date_to','supplier_count'));
    }

    public function supplier_report_with_date(Request $request)
    {
        //
        $date_from = "";
        $date_to = "";
        $status ="";

        if($request->date_from == null && $request->$date_to == null){
            $date_from = date('Y-m-d H:i:s', strtotime("Monday This Week"));
            $date_to = date('Y-m-d H:i:s', strtotime("Sunday This Week"));
            $status = "Uncheck";
        }else{
            $date_from = date('Y-m-d H:i:s', strtotime($request->date_from));
            $date_to = date('Y-m-d H:i:s', strtotime($request->date_to));
            $status = 'Uncheck';
        }

        

        $supplier = Supplier::with('user')->where('created_at','>=',$date_from)->where('created_at','<=',$date_to)->where('status','=',$status)->get();
        $supplier_count = $supplier->count();
        return view('supplier.supplier-report', compact('supplier','date_from','date_to','supplier_count'));
    }
}
