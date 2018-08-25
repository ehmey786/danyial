<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\File;
use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $data['groups_count'] = Group::all()->count();
        $data['company_count'] = Company::all()->count();
        $data['employee_count'] = Employee::all()->count();
        $data['files_count'] = File::all()->count();
        return view('welcome', compact('data'));
    }


    public function groups()
    {
        $data['groups'] = Group::paginate(10);
        return view('groups', compact('data'));
    }


    public function save_group(Request $request)
    {
        Group::create($request->except(['_token']));
        return redirect()->back();
    }


    public function update_document($id,Request $request){
        $emp_id=Employee::find($id);
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = $emp_id->id.'.' . $file->getClientOriginalExtension();
            $folderPath = public_path('documents/');
            $file->move($folderPath, $fileName);
        }
        return redirect()->back();
    }

    public function save_employee(Request $request)
    {
        $emp_id=Employee::create($request->except(['_token']));
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = $emp_id->id.'.' . $file->getClientOriginalExtension();
            $folderPath = public_path('documents/');
            $file->move($folderPath, $fileName);
        }
        return redirect()->back();
    }


    public function delete_group($id)
    {
        Group::destroy($id);
        return redirect()->back();
    }


    public function notificationsAll(){
        $data['notifications']=null;
        $data['notifications_count']=null;
        return view('notifications', compact('data'));
    }

    public function group_companies($id)
    {
        $data['companies'] = Group::find($id)->companies()->paginate(10);
        $data['group'] = Group::find($id);
        return view('companies', compact('data'));
    }

    public function save_company(Request $request)
    {
        //try
        {
            Company::create($request->except(['_token']));
            return redirect()->back();
        }
      //  catch(\Exception $exception)
        {
         //   \Session::flash('error',$exception->getMessage());
            return redirect()->back();
        }
    }


    public function all_files($id)
    {
        $data['company'] = Company::find($id);
        $data['files'] = Company::find($id)->files()->paginate(10);
        return view('files', compact('data'));
    }


    public function all_employees($id)
    {
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


    public function delete_employee($id)
    {
        Employee::destroy($id);
        return redirect()->back();
    }

    public function save_file(Request $request)
    {
        try {
            $file = $request->file('file');
            $fileName = $request->name . "-" . time() . '.' . $file->getClientOriginalExtension();
            $folderPath = public_path('files/');
            File::create(['name' => 'files/' . $fileName, 'company_id' => $request->company_id]);

            $file->move($folderPath, $fileName);


            $return['message'] = "Session created successfully";
            $return['message_type'] = "success";
            return redirect()->back();

        } catch (\Exception $exception) {
            $return['message'] = $exception->getMessage();
            $return['message_type'] = "error";
            return redirect()->back();
        }
    }


}