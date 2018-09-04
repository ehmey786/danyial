<?php

namespace App\Http\Controllers;

use App\Company;
use App\Dpendent;
use App\Employee;
use App\File;
use App\Group;
use App\Notification;
use App\Notifications\companyExpiary;
use App\ShareHolder;
use App\Task;
use Auth;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $data['task_count'] = Task::all()->count();
        $data['company_count'] = Company::all()->count();
        $data['employee_count'] = Employee::all()->count();
        $data['files_count'] = File::all()->count();
        return view('welcome', compact('data'));
    }


    public function edit_company($id, Request $request)
    {

        $company = Company::find($id);
        $from = \Carbon\Carbon::parse($request->expiry);
        $to = \Carbon\Carbon::now();


        $vatFrom = \Carbon\Carbon::parse($request->vat_date);


        if ($to->diffInMonths($vatFrom, true) > 1) {
            $notifications = Notification::where('data', 'like', '%VAT%')->where('data', 'like', '%' . $company->name . '%')->where('data', 'like', '%' . $company->vat_date . '%');

            foreach ($notifications->get() as $notification) {
                //     dd($notification);
                $notification->delete();

            }
        }

        if ($to->diffInMonths($from, true) > 1) {
            $notifications = Notification::where('data', 'like', '%' . $company->name . '%')->where('data', 'like', '%' . $company->expiry . '%');
            echo $company->name;
            echo $company->expiry;
            //   dd($notifications->get() );
            foreach ($notifications->get() as $notification) {
                //     dd($notification);
                $notification->delete();

            }
        }

        $company->update($request->except(['_token']));
        return redirect()->back();
    }


    public function statusChange(Request $request)
    {
        Task::find($request->id)->update(['status' => $request->status]);
        return redirect()->back();
    }

    public function saveTask(Request $request)
    {
        Task::create($request->except(['_token']));
        return redirect()->back();
    }


    public function taskDelete($id)
    {
        Task::destroy($id);
        return redirect()->back();
    }

    public function tasks()
    {
        $data['tasks'] = Task::paginate(20);
        return view('tasks', compact('data'));
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


    public function update_document($id, Request $request)
    {
        $emp_id = Employee::find($id);
        $fileName = null;
        $fileName2 = null;
        $fileName3 = null;
        $fileName4 = null;
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = $emp_id->id . '1_company_document' . '.' . $file->getClientOriginalExtension();
            $folderPath = public_path('documents/');
            $file->move($folderPath, $fileName);
        }
        if ($request->has('file2')) {
            $file = $request->file('file2');
            $fileName2 = $emp_id->id . '2_company_document' . '.' . $file->getClientOriginalExtension();
            $folderPath = public_path('documents/');
            $file->move($folderPath, $fileName2);
        }
        if ($request->has('file3')) {
            $file = $request->file('file3');
            $fileName3 = $emp_id->id . '3_company_document' . '.' . $file->getClientOriginalExtension();
            $folderPath = public_path('documents/');
            $file->move($folderPath, $fileName3);
        }
        if ($request->has('file4')) {
            $file = $request->file('file4');
            $fileName4 = $emp_id->id . '4_company_document' . '.' . $file->getClientOriginalExtension();
            $folderPath = public_path('documents/');
            $file->move($folderPath, $fileName);
        }
        if ($fileName != null && $fileName2 != null && $fileName3 != null && $fileName4 != null) {
            $emp_id->update(['image_1' => $fileName, 'image_2' => $fileName2, 'image_3' => $fileName3, 'image_4' => $fileName4]);
        } elseif ($fileName == null && $fileName2 != null && $fileName3 != null && $fileName4 != null) {
            $emp_id->update(['image_2' => $fileName2, 'image_3' => $fileName3, 'image_4' => $fileName4]);
        } elseif ($fileName == null && $fileName2 == null && $fileName3 != null && $fileName4 != null) {
            $emp_id->update(['image_3' => $fileName3, 'image_4' => $fileName4]);
        } elseif ($fileName == null && $fileName2 == null && $fileName3 == null && $fileName4 != null) {
            $emp_id->update(['image_4' => $fileName4]);
        }

        return redirect()->back();
    }

    public function save_employee(Request $request)
    {
        $emp_id = Employee::create($request->except(['_token']));
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileName = $emp_id->id . '.' . $file->getClientOriginalExtension();
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


    public function notificationsAll()
    {
        $companies = Company::all();


        foreach ($companies as $company) {
            if ($company->notify != 1) {
                $from = \Carbon\Carbon::parse($company->expiry);
                $to = \Carbon\Carbon::now();
                if ($to->diffInMonths($from, true) < 1) {
                    \Notification::send(Auth::user(), new companyExpiary("This company <b>" . $company->name . "</b> is going to expire on this date " . $company->expiry));
                }
            }


            if ($company->vat_notify != 1) {
                $from = \Carbon\Carbon::parse($company->vat_date);
                $to = \Carbon\Carbon::now();
                if ($to->diffInDays($from, true) < 15) {
                    \Notification::send(Auth::user(), new companyExpiary("This company <b>" . $company->name . "</b> VAT DATE  is going to expire on this date " . $company->vat_date));
                }
            }

            $company->vat_notify = 1;
            $company->save();

        }


        $data['notifications'] = Auth::user()->notifications()->orderby('id', 'desc')->take(100)->paginate(20);
        $data['notifications_count'] = count(Auth::user()->notifications);
        return view('notifications', compact('data'));
    }


    public function companyProfile($id)
    {
        $data['company'] = Company::find($id);

        return view('company-profile', compact('data'));
    }


    public function deleteShareHolder($id)
    {
        ShareHolder::destroy($id);

        return redirect()->back();
    }


    public function saveShareHolders(Request $request)
    {
        ShareHolder::create($request->except(['_token']));
        return redirect()->back();
    }

    public function group_companies(Request $request)
    {
        if (!empty($request->search_input)) {
            $data['companies'] = Group::find(1)->companies()
                ->where('name', 'like', '%' . $request->search_input . '%')
                ->orwhere('zone', 'like', '%' . $request->search_input . '%')
                ->orwhere('origin', 'like', '%' . $request->search_input . '%')
                ->paginate(1000);
            $data['group'] = Group::find(1);
            //  dd(1);
            return view('companies', compact('data'));
        }


        $data['companies'] = Group::find(1)->companies()->paginate(10);
        $data['group'] = Group::find(1);
        return view('companies', compact('data'));
    }

    public function save_company(Request $request)
    {
        try {
            $company = Company::create($request->except(['_token']));

            return redirect()->back();
        } catch (\Exception $exception) {
            \Session::flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }


    public function all_files($id)
    {
        $data['company'] = Company::find($id);
        $data['files'] = Company::find($id)->files()->paginate(10);
        return view('files', compact('data'));
    }


    public function saveDependent(Request $request)
    {


        $file = $request->file('document');
        $fileName = $request->name . "-" . time() . '.' . $file->getClientOriginalExtension();
        $folderPath = public_path('files/');


        $file->move($folderPath, $fileName);


        Dpendent::create([
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'visa_expiry_expiry' => $request->visa_expiry_expiry,
            'passport_expiry' => $request->passport_expiry,
            'relation' => $request->relation,
            'document' => $fileName
        ]);


        return redirect()->back();
    }


    public function deleteDependent($id)
    {
        Dpendent::destroy($id);
        return redirect()->back();
    }

    public function dependents($id, Request $request)
    {
        $data['dependents'] = Employee::find($id)->dependents()->paginate(10);
        $data['employee'] = Employee::find($id);
        return view('dependents', compact('data'));
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