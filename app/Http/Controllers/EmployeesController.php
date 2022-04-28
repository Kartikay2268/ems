<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeDetails;
use App\Http\Requests\SalaryUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Salary;

class EmployeesController extends Controller
{

    public function index()
    {
        try {
            $users = User::getEmployees();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        foreach ($users as $user) {
            try {
                $employee = User::find($user->id);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }


            $joiningDate = explode('-', $user->doj);

            if (count($joiningDate) >= 2) {
                $joiningYear = (int)$joiningDate[0];
                $joiningMonth = (int)$joiningDate[1];
            } else {
                $joiningYear = 2020;
                $joiningMonth = 01;
            }

            $currentYear = (int)date("Y");
            $currentMonth = (int)date("m");


            $experienceYear = $currentYear - $joiningYear;
            $experienceMonth = $currentMonth - $joiningMonth;

            if ($experienceMonth <= 0) {
                $experienceYear = $experienceYear - 1;
                $experienceMonth = 12 - abs($experienceMonth);
                $employee->experience = $experienceYear;
                if ($experienceYear == 0) {
                    $user->doj = $experienceMonth . " Months";
                } else {
                    $user->doj = $experienceYear . " Year " . $experienceMonth . " Months";
                }

            } else {
                $employee->experience = $experienceYear;
                $user->doj = $experienceYear . " Year " . $experienceMonth . " Months";
            }

            try {
                $employee->save();
            } catch (\Exception $exception) {
                return $exception->getMessage();
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
                default:
                    $user->role = "Employee";
            endswitch;

        }
        return view('employees', compact('users'));
    }

    /**
     * @param Request $request -> contains the role and experience values for filter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View|string
     */

    public function filterEmployee(Request $request)
    {


        if ($request->role != "Choose Role") {
            try {
                $users = User::getUsers($request->role);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }
        if ($request->exp != "") {
            try {
                $users = User::filterExperience((int)$request->exp);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }
        if ($request->role != "Choose Role" && $request->exp != "") {
            try {
                $users = User::filter($request->role, (int)$request->exp);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }
        if ($request->role == "Choose Role" && $request->exp == "") {
            return redirect(route('employees'));
        }


        foreach ($users as $user) {

            $joiningDate = explode('-', $user->doj);

            if (count($joiningDate) >= 2) {
                $joiningYear = (int)$joiningDate[0];
                $joiningMonth = (int)$joiningDate[1];
            } else {
                $joiningYear = 2020;
                $joiningMonth = 01;
            }

            $currentYear = (int)date("Y");
            $currentMonth = (int)date("m");

            $experienceYear = $currentYear - $joiningYear;
            $experienceMonth = $currentMonth - $joiningMonth;


            if ($experienceMonth <= 0) {
                $experienceYear = $experienceYear - 1;
                $month = 12 - abs($experienceMonth);
                if ($experienceYear == 0) {
                    $user->doj = $month . " Months";
                } else {
                    $user->doj = $experienceYear . " Year " . $experienceMonth . " Months";
                }

            } else {
                $user->doj = $experienceYear . " Year " . $experienceMonth . " Months";
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
                default:
                    $user->role = "Employee";
            endswitch;

        }

        return view('employees', compact('users'));
    }

    /**
     * Return the view for adding the employee
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */

    public function addEmployee()
    {

        return view('add_employee');
    }

    /**
     * Update the DB with new employee information
     * @param EmployeeDetails $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */

    public function submitEmployee(EmployeeDetails $request)
    {

        $employeeInfo = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'empId' => $request->empId,
            'role' => $request->role,
            'designation' => $request->designation,
            'phone' => $request->phone,
            'address' => $request->address,
            'bloodGroup' => $request->bloodGroup,
            'dob' => $request->dob,
            'doj' => $request->doj
        ];

        try {
            User::addEmployee($employeeInfo);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect('/employees');


    }

    /**
     * @param Request $request
     * @param $empId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View\
     */

    public function editEmployee(Request $request, $empId)
    {

        $user = User::getUser($empId)->first();

        return view('edit_employee', ['user' => $user]);
    }

    /**
     * Edit the information of the existing employee in DB
     * @param EmployeeDetails $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */

    public function updateEmployee(EmployeeDetails $request)
    {

        $employeeInfo = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'empId' => $request->empId,
            'role' => $request->role,
            'designation' => $request->designation,
            'phone' => $request->phone,
            'address' => $request->address,
            'bloodGroup' => $request->bloodGroup,
            'dob' => $request->dob,
            'doj' => $request->doj
        ];

        try {
            User::editEmployee($employeeInfo, $request->empId);
            return redirect('/employees');

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param Request $request
     * @param $empId
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */

    public function deleteEmployee(Request $request, $empId)
    {
        try {
            User::deleteEmployee($empId);

        } catch (\Exception $exception) {

            return $exception->getMessage();
        }
        return redirect('/employees');

    }

    /**
     * Return the view for Salary Details
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */

    public function salaryDetails(Request $request)
    {
        $user = User::getUser($request->id)->first();
        $salary = Salary::getSalary($request->id);

        return view('salary', ['user' => $user, 'salary' => $salary]);
    }

    /**
     * Update the salary information of the employee in DB
     * @param SalaryUpdate $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */

    public function salaryUpdate(SalaryUpdate $request)
    {

        $salaryInfo = [
            'empId' => $request->empId,
            'fixed' => $request->fixed,
            'variable' => $request->variable,
            'ctc' => $request->ctc
        ];

        $salary = Salary::getSalary($request->empId);

        if (!isset($salary)) {

            try {
                Salary::addSalary($salaryInfo);

            } catch (\Exception $e) {

                return redirect(route('salaryDetails', $request->empId));
            }

        } else {

            try {

                Salary::editSalary($salaryInfo, $salary->id);

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

    public function getEmployees(Request $request)
    {

        $query = User::query();

        $perpage = 20;
        $page = $request->input('page', 1);
        $total = $query->count();

        $result = $query->offset(($page - 1) * $perpage)->limit($perpage)->get();

        return [
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'last_page' => ceil($total / $perpage)
        ];

    }

}
