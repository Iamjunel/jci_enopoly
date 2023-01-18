<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Client;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with('user')->get();
        return view('company', compact('companies'));
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:company'],
            'address' => 'required',
            'phone' => 'required',
            'added_by' => 'required',
        ]);

        Company::create($request->post());

        return redirect()->route('client_corr.company.index')->with('success', 'Company has been created successfully.');
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => 'required',
            'phone' => 'required',
            'added_by' => 'required',
        ]);

        $company = Company::where('id',$id)->first();
        
        if(!empty($company)){
            $company->update($request->post());
        }        

        return redirect()->route('client_corr.company.index')->with('success', 'Company has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check_client = Client::where('company_id',$id)->first();
        if(!empty($check_client)){
            return redirect()->back()->with('failed', 'Company cannot be deleted.');
        }else{
            $company = Company::find($id);
            $company->delete();

            return redirect()->route('client_corr.company.index')->with('success', 'Company has been deleted successfully.');
        }

        
    }
}
