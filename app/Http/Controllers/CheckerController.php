<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CheckerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier = new Supplier();

        $daily_supplier_count_user   = $supplier->where('created_at', '>=', date('Y-m-d').' 00:00:00')->where('added_by','=',Auth::user()->id)->count(); 
        $daily_supplier_count        = $supplier->where('created_at', '>=', date('Y-m-d').' 00:00:00')->count(); 
        $weekly_supplier_count       = $supplier->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthly_supplier_count      = $supplier->whereMonth('created_at', Carbon::now()->month)->count();
        $yearly_supplier_count       = $supplier->whereYear('created_at', Carbon::now()->year)->count();
        $suppliers_data              = $supplier->with('checker')->where('checker_id','!=',null)->orderBy('created_at', 'desc')->get();
        
        //checker
        $daily_supplier_valid_count        = $supplier->where('checker_updated_at', '>=', date('Y-m-d').' 00:00:00')->where('status','=','Valid')->count(); 
        $daily_supplier_invalid_count        = $supplier->where('checker_updated_at', '>=', date('Y-m-d').' 00:00:00')->where('status','=','Invalid')->count(); 

        $supplier_array = array();
        $supplier_array["suppliers_data"] = $suppliers_data;
        $supplier_array["daily_supplier"] = $daily_supplier_count;
        $supplier_array["weekly_supplier"] = $weekly_supplier_count;
        $supplier_array["monthly_supplier"] = $monthly_supplier_count;
        $supplier_array["yearly_supplier"] = $yearly_supplier_count;
        $supplier_array["daily_supplier_user"] = $daily_supplier_count_user;
        
         //checker 
        $supplier_array["daily_supplier_valid"] = $daily_supplier_valid_count;
        $supplier_array["daily_supplier_invalid"] = $daily_supplier_invalid_count;
        
       
        


        return view('checker.checker_dashboard', compact('supplier_array'));
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

    public function checker_index(){
        $supplier = Supplier::with('user')->whereNull('checker_id')->get();
        return view('checker.checker',compact('supplier'));
    }
    public function checker_checked(){
        $supplier = Supplier::with('user')->where('checker_id','!=',null)->where('caller_id','=',null)->get();
        return view('checker.checked',compact('supplier'));
    }

    public function supplier_report()
    {
        //
         $date_from = date('Y-m-d', strtotime("Monday This Week"));
         $date_to = date('Y-m-d', strtotime("Sunday This Week"));
         $status = 'Valid';

        $supplier = Supplier::with('checker')->whereDate('checker_updated_at','>=',$date_from)->whereDate('checker_updated_at','<=',$date_to)->where('status','=',$status)->get();
         $supplier_count = $supplier->count();
        return view('checker.checker-report', compact('supplier','date_from','date_to','status','supplier_count'));
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
            $status = "Valid";
        }else{
            $date_from = date('Y-m-d H:i:s', strtotime($request->date_from));
            $date_to = date('Y-m-d H:i:s', strtotime($request->date_to));
            $status = $request->status;
        }
        if($status == 'Uncheck'){
             $supplier = Supplier::with('user')->where('created_at','>=',$date_from)->where('created_at','<=',$date_to)->where('status','=',$status)->get();
        }else{
             $supplier = Supplier::with('checker')->where('checker_updated_at','>=',$date_from)->where('checker_updated_at','<=',$date_to)->where('status','=',$status)->get();
        }
        $supplier_count = $supplier->count();
        return view('checker.checker-report', compact('supplier','date_from','date_to','status','supplier_count'));
    }
}
