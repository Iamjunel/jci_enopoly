<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class SourcerController extends Controller
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
        $suppliers_data              = $supplier->with('user')->where('status','=','Incomplete')->where('created_at', '>=', date('Y-m-d').' 00:00:00')->orderBy('created_at', 'desc')->get();

        $supplier_array = array();
        $supplier_array["suppliers_data"] = $suppliers_data;
        $supplier_array["daily_supplier"] = $daily_supplier_count;
        $supplier_array["weekly_supplier"] = $weekly_supplier_count;
        $supplier_array["monthly_supplier"] = $monthly_supplier_count;
        $supplier_array["yearly_supplier"] = $yearly_supplier_count;
        $supplier_array["daily_supplier_user"] = $daily_supplier_count_user;


        return view('supplier.supplier_dashboard', compact('supplier_array'));
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
}
