<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Designation;


use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File;



//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        $datas = DB::table('employees')
            ->join('designations', 'employees.designation_id', '=', 'designations.id')
            ->select('employees.*', 'designations.designation')
             ->get();
        ;
        return view('layouts.employees_list',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::all();
        return view('layouts.employees_create',compact('designations'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $designations = Designation::all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees',
            'designation' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);


        $employee = new employee();
        $employee->name= $request->input('name');
        $employee->email= $request->input('email');
       // $employee->password= $hashed_random_password = Hash::make(uniqid());
         $employee->password =Str::random(9);
        $employee->designation_id= $request->input('designation');
        $employee->remarks= $request->input('remarks');
        if($request->hasFile('image')){


            $file=$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/employees/',$filename);
            $employee->image= $filename;

        }
        $employee->save();

        Mail::to($employee->email)->send(new WelcomeMail($employee));

        return redirect()->back()->with('status','employee added successfully');

        //return view('layouts.employees_create',compact('designations'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $employee = Employee::find($id);
        $employee = DB::table('employees')
            ->join('designations', 'employees.designation_id', '=', 'designations.id')
            ->where('employees.id','=',$id)
            ->select('employees.*', 'designations.designation')
            ->get();
         return view('layouts.employee_show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $employee = Employee::find($id);
        $designations = Designation::all();




        return view('layouts.employee_edit',compact('employee','designations'));
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

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'designation' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        $employee = Employee::find($id);
        $employee->name= $request->input('name');
        $employee->email= $request->input('email');
       // $employee->password =Str::random(9);
        $employee->designation_id= $request->input('designation');
        $employee->remarks= $request->input('remarks');
        if($request->hasFile('image')){

            if($employee->image){
                File::delete('uploads/employees/'.$employee->image);
            }

            $file=$request->file('image');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/employees/',$filename);
            $employee->image= $filename;

        }
        $employee->save();

        return redirect()->back()->with('status','employee updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if($employee->image){
            File::delete('uploads/employees/'.$employee->image);
        }
        $employee->delete();
        return redirect('/employees')->with('status','Successfully deleted');
    }
}
