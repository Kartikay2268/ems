<?php

namespace App\Http\Controllers;

use App\Http\Models\Salary;
use App\Http\Models\Team;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;

class DetailsController extends Controller
{
    public function index() {

        try {
            $users = User::getUser(Auth::user()->empId);
            $salary = Salary::getSalary(Auth::user()->empId);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        try {
            $team = Team::getTeam($users->first()->team_id);
            $managerName = User::getName($team->manager);
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
                default:
                    $user->role = "Employee";
                    break;
            endswitch;
        }


        return view('details', ['users' => $users, 'salary' => $salary, 'team' => $team, 'managerName' => $managerName]);
    }
}
