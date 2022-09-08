<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Validator,Redirect;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input['employees'] = DB::table('employees')
        ->leftjoin('companies','companies.id','=','employees.company_id')
            ->select('companies.name as company','employees.*')
            ->get();
        $input['companies'] = Company::all();
        return view('employee.index',$input);
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
        $validator = Validator::make($request->all(),
            [
                'first_name'=>'required',
                'last_name'=>'required',
            ]
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $input = $request->only([
            'first_name',
            'last_name',
            'company_id',
            'email',
            'phone',
        ]);

        Employee::insert($input);
        return redirect('/employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $input['employee'] = DB::table('employees')
            ->leftjoin('companies','companies.id','=','employees.company_id')
            ->select('companies.name as company','employees.*')
            ->first();
        $input['companies'] = Company::all();
        return view('employee.edit',$input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name'=>'required',
                'last_name'=>'required',
            ]
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $input = $request->only([
            'first_name',
            'last_name',
            'company_id',
            'email',
            'phone',
        ]);

//dd($input);
        $employee->update($input);
        return redirect('/employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        return $employee->delete();
    }
}
