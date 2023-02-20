<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
class ProductAnalyzerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        //
        $products = Product::all();
        return 'hello';
        return view('product_analyzer.index',compact('products'));
    } 
    public function index()
    {
        //
        $products = Product::with('user')->orderBy('id','desc')->get();
        $supplier = Supplier::where('status','=','Approved')->get();
        return view('product_analyzer.index',compact('products','supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $supplier = Supplier::where('status','=','Approved')->get();
        return view('product_analyzer.create',compact('supplier'));
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
        Product::create($request->post());

        return redirect()->route('pa_product.index')->with('success', 'Product has been created successfully.');
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

        $product = Product::with('user')->where('id',$id)->first();
        $supplier = Supplier::where('status','=','Approved')->get();
        
        return view('product_analyzer.edit', compact('product','supplier'));
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
         $product = Product::where('id',$id)->first();
         $product->update($request->post());
         return redirect()->route('pa_product.index')->with('success', 'Product has been updated successfully.');
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
