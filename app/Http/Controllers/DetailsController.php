<?php

namespace App\Http\Controllers;

use App\Salary;
use App\Team;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class DetailsController extends Controller
{
    public function index() {

        $users = User::where('empId',Auth::user()->empId)->get();
        $salary = Salary::where('empId', Auth::user()->empId)->first();
        try {
            $team = Team::where('id', $users->first()->team_id)->first();
            $managerName = User::where('empId', $team->manager)->first()->name;
        } catch (\Exception $e) {
            $team = null;
            $managerName = null;
        }
        foreach ($users as $user) {
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


        return view('details', ['users' => $users, 'salary' => $salary, 'team' => $team, 'managerName' => $managerName]);
    }
}
