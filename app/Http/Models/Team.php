<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'manager'
    ];

    private function validate($data)
    {
        if (empty($data)) {
            throw new \Exception("Invalid Parameters Passed");
        }
    }

    public static function getTeam($id)
    {
        return self::where('id', $id)->get()->first();
    }

    public static function getTeams()
    {
        return self::paginate(5);
    }

    public static function getManagerTeam($managerId)
    {
        return self::where('manager', $managerId)->first();
    }

    public static function addTeam($teamInfo)
    {
        (new self())->validate($teamInfo);
        return self::create($teamInfo);
    }

    public static function getTeamName($teamId)
    {
        return self::where('id', $teamId)->get()->first()->name;
    }

    public static function deleteTeam($id)
    {
        $team = self::find($id);
        return $team->delete();
    }

    public static function editTeam($teamInfo)
    {
        (new self())->validate($teamInfo);

        $team = Team::find($teamInfo['id']);
        if ($team->name != $teamInfo['name']) {
            $team->name = $teamInfo['name'];
        }
        if ($team->manager != $teamInfo['manager']) {
            $team->manager = $teamInfo['manager'];
        }

        return $team->save();

    }

    public static function getManagerId($teamId)
    {
        return self::where('id', $teamId)->first()->manager;
    }

}
