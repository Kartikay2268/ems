<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeDetails;
use App\Http\Requests\SalaryUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Salary;

class EmployeesController extends Controller
{

    public function index()
    {
        $users = User::getEmployees();
        foreach ($users as $user){
            $employee = User::find($user->id);
            $year = explode('-',$user->doj);
            $experience = (int)date("Y") - (int)$year[0];
            $month = (int)date("m") - (int)$year[1];
            if($month <= 0){
                $experience = $experience - 1;
                $month = 12 - abs($month);
                $employee->experience = $experience;
                if($experience == 0){
                    $user->doj = $month." Months";
                } else {
                    $user->doj = $experience." Year ".$month." Months";
                }

            } else {
                $employee->experience = $experience;
                $user->doj = $experience." Year ".$month." Months";
            }

            $employee->save();

            switch ($user->role):
                case "admin":
                    $user->role = "Admin";
                    break;
                case "emp":
                    $user->role = "Employee";
                    break;
                case "manager":
                    $user->role = "Manager";
                    break;
            endswitch;

        }
        return view('employees', compact('users'));
    }

    public function filterEmployee(Request $request){


        if($request->role != "Choose Role") {
            $users = User::getUsers($request->role);
        }
        if($request->exp != "") {
             $users = User::where('experience',(int)$request->exp)->paginate(5);
        }
        if($request->role != "Choose Role" && $request->exp != ""){
            $users = User::where('experience',(int) $request->exp)->where('role', $request->role)->paginate(5);
        }
        if($request->role == "Choose Role" && $request->exp == ""){
            return redirect(route('employees'));
        }


        foreach ($users as $user){
            $year = explode('-',$user->doj);
            $experience = (int)date("Y") - (int)$year[0];
            $month = (int)date("m") - (int)$year[1];
            if($month <= 0){
                $experience = $experience - 1;
                $month = 12 - abs($month);
                if($experience == 0){
                    $user->doj = $month." Months";
                } else {
                    $user->doj = $experience." Year ".$month." Months";
                }

            } else {
                $user->doj = $experience." Year ".$month." Months";
            }

            switch ($user->role):
                case "admin":
                    $user->role = "Admin";
                    break;
                case "emp":
                    $user->role = "Employee";
                    break;
                case "manager":
                    $user->role = "Manager";
                    break;
            endswitch;

        }

        return view('employees', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */

    public function addEmployee() {

        return view('add_employee');
    }

    public function submitEmployee(EmployeeDetails $request){

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'empId'=> $request->empId,
            'role' => $request->role,
            'designation' => $request->designation,
            'phone' => $request->phone,
            'address' => $request->address,
            'bloodGroup' => $request->bloodGroup,
            'dob' => $request->dob,
            'doj' => $request->doj
        ];

            try {

                User::addEmployee($data);

                return redirect('/employees');

            } catch (\Exception $e) {
                return $e->getMessage();
            }


    }

    public function editEmployee(Request $request, $id){

        $user = User::getUser($id)->first();

        return view('edit_employee', ['user'=> $user]);
    }

    public function updateEmployee(EmployeeDetails $request){

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'empId'=> $request->empId,
            'role' => $request->role,
            'designation' => $request->designation,
            'phone' => $request->phone,
            'address' => $request->address,
            'bloodGroup' => $request->bloodGroup,
            'dob' => $request->dob,
            'doj' => $request->doj
        ];

        try {
            User::editEmployee($data, $request->empId);
            return redirect('/employees');

        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }

    public function deleteEmployee(Request $request, $eid){
        try {
            User::deleteEmployee($eid);
            return redirect('/employees');
        } catch (\Exception $exception) {}
        return $exception->getMessage();
    }

    public function salaryDetails(Request $request) {
        $user = User::getUser($request->id)->first();
        $salary = Salary::getSalary($request->id);

        return view('salary', ['user'=>$user, 'salary'=>$salary]);
    }

    public function salaryUpdate(SalaryUpdate $request){

        $data = [
            'empId' => $request->empId,
            'fixed' => $request->fixed,
            'variable' => $request->variable,
            'ctc' => $request->ctc
        ];

        $salary = Salary::getSalary($request->empId);

        if (!isset($salary)) {

            try{
                Salary::addSalary($data);

            } catch (\Exception $e) {

                return redirect(route('salaryDetails', $request->empId));
            }

        } else {

            try {

                Salary::editSalary($data, $salary->id);

            } catch (\Exception $e) {

                return redirect(route('salaryDetails', $request->empId));
            }
        }
        switch (Auth::user()->role) {
            case 'admin':
                return redirect(route('employees'));
            case 'manager':
                return redirect(route('managerTeam'));
        }

    }

}
