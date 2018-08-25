<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Group;
use App\File;
use App\Company;
use App\Employee;

class GroupController extends Controller
{
    public function index()
    {
        $data['groups'] = Group::paginate(10);
        return view('groups', compact('data'));
    }

    public function save_group(Request $request)
    {
        Group::create($request->except(['_token']));
        return redirect()->back();
    }

    public function save_employee(Request $request)
    {
        Employee::create($request->except(['_token']));
        return redirect()->back();
    }


    public function delete_group($id)
    {
        Group::destroy($id);
        return redirect()->back();
    }


    public function group_companies($id)
    {
        $data['companies'] = Group::find($id)->companies()->paginate(10);
        $data['group'] = Group::find($id);
        return view('companies', compact('data'));
    }

    public function save_company(Request $request)
    {
        Company::create($request->except(['_token']));
        return redirect()->back();
    }


    public function all_files($id)
    {
        $data['company'] = Company::find($id);
        $data['files'] = Company::find($id)->files()->paginate(10);
        return view('files', compact('data'));
    }


    public function all_employees($id){
        $data['company'] = Company::find($id);
        $data['employees'] = Company::find($id)->employees()->paginate(10);
        $data['count_employees'] = Company::find($id)->employees;

        return view('employees', compact('data'));
    }


    public function delete_company($id)
    {
        Company::destroy($id);
        return redirect()->back();
    }


    public function delete_file($id)
    {
        File::destroy($id);
        return redirect()->back();
    }


    public function delete_employee($id){
        Employee::destroy($id);
        return redirect()->back();
    }

    public function save_file(Request $request){
        //try
        {
            $file=$request->file('file');
            $fileName = $request->name."-".time() . '.' . $file->getClientOriginalExtension();
            $folderPath = public_path('files/' );
File::create(['name'=>'files/'.$fileName,'company_id'=>$request->company_id]);

            $file->move($folderPath, $fileName);


            $return['message'] = "Session created successfully";
            $return['message_type'] = "success";
            return redirect()->back();

        } //catch (\Exception $exception)

        {
          //  $return['message'] = $exception->getMessage();
            $return['message_type'] = "error";
            return redirect()->back();
        }
    }


}