<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamDetails;
use Illuminate\Http\Request;
use App\User;
use App\Team;

class TeamController extends Controller
{
    public function index()
    {

        try {
            $teams = Team::getTeams();
            $managers = User::getManagers();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        foreach ($managers as $manager) {
            foreach ($teams as $team) {
                if ($manager->empId == $team->manager) {
                    $team->managerName = $manager->name;
                }
            }
        }
        return view('team_admin', compact('teams'));
    }

    public function addTeam()
    {

        try {
            $managers = User::getManagers();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return view('add_team', ['managers' => $managers]);
    }

    public function submitTeam(TeamDetails $request)
    {

        $teamInfo = [
            'name' => $request->team_name,
            'manager' => $request->team_manager
        ];

        try {
            Team::addTeam($teamInfo);

        } catch (\Exception $e) {
            return redirect('teams/add');
        }
        return redirect('/teams');


    }

    public function manageTeam(Request $request)
    {

        try {
            $members = User::getTeamMembers($request->id);
            $name = Team::getTeamName($request->id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return view('manage_team', compact('members'))->with(['team_id' => $request->id, 'members' => $members, 'name' => $name]);
    }

    public function addMember(Request $request)
    {
        try {
            $name = Team::getTeamName($request->id);
            $employees = User::getFreeEmployees();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return view('add_member', ['name' => $name, 'employees' => $employees, 'team_id' => $request->id]);
    }

    public function addMemberSubmit(Request $request)
    {

        try {
            User::setTeam($request->member_id, $request->team_id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return redirect(route('teams.manage', $request->team_id));
    }

    public function deleteMember(Request $request)
    {

        try {
            User::unsetTeam($request->member_id);
        } catch (\Exception $e) {
            return redirect(route('teams.manage', $request->id));
        }
        return redirect(route('teams.manage', $request->id));

    }

    public function deleteTeam(Request $request)
    {
        try {

            Team::deleteTeam($request->team_id);


        } catch (\Exception $e) {

            return redirect(route('teams'));
        }
        return redirect(route('teams'));
    }

    public function editTeam(Request $request)
    {
        try {
            $team = Team::getTeam($request->id);
            $managers = User::getManagers();
            $oldManager = User::getName($team->manager);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return view('edit_team', ['team' => $team, 'managers' => $managers, 'oldManager' => $oldManager]);
    }

    public function editTeamSubmit(TeamDetails $request)
    {

        $teamInfo = [
            'name' => $request->team_name,
            'manager' => $request->team_manager,
            'id' => $request->team_id
        ];

        try {
            Team::editTeam($teamInfo);
        } catch (\Exception $e) {
            return redirect(route('teams.editTeam', $request->team_id));
        }
        return redirect(route('teams'));

    }

}
