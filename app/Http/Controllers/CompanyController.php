<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Validator,Redirect;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index',compact('companies'));
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
        $validator = Validator::make($request->all(), array(
            'name' => 'required',
            'email' => 'unique:companies,email',
            'logo'=>'mimes:jpeg,jpg,png,gif|dimensions:min_width=100,min_height=100'
        ), array(
            'email.unique'         => 'Email already exists!',
            'email.dimensions'         => 'Logo image should be greater than 100x100',
        ));
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $input = $request->only([
            'name',
            'email',
            'website',
            'logo',
        ]);
        if(isset($request->logo) && $request->logo) {
            $input['logo']= image_upload($request->logo);
        }
        Company::insert($input);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), array(
            'name' => 'required',
            'logo'=>'mimes:jpeg,jpg,png,gif|dimensions:min_width=100,min_height=100'
        ), array(
            'email.unique'         => 'Email already exists!',
            'email.dimensions'         => 'Logo image should be greater than 100x100',
        ));
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $input = $request->only([
            'name',
            'email',
            'website',
            'logo',
        ]);
        if(isset($request->logo) && $request->logo) {
            $input['logo']= image_upload($request->logo);
        }
        $company->update($input);
        return redirect('/company');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        return $company->delete();
    }
}
