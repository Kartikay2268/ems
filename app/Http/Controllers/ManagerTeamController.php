<?php

namespace App\Http\Controllers;

use App\Http\Models\Team;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerTeamController extends Controller
{
    public function index()
    {
        $team = Team::getManagerTeam(Auth::user()->empId);
        $teamName = $team->name;
        $teamId = $team->id;

        $members = User::getTeamMembers($teamId);

        return view('manager.team', compact('members'))
            ->with(['teamName' => $teamName]);
    }

    public function viewMember(Request $request)
    {
        $users = User::getUser($request->id);
        return view('details', ['users' => $users]);
    }
}
