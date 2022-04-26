<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'manager'
    ];

    private function validate($data) {
        if(empty($data)) {
            throw new \Exception("Invalid Parameters Passed");
        }
    }

    public static function getTeam($id) {
        return self::where('id', $id)->get()->first();
    }

    public static function getTeams() {
        return self::paginate(5);
    }

    public static function getManagerTeam($managerId) {
        return self::where('manager', $managerId)->first();
    }

    public static function addTeam($data) {
        (new self())->validate($data);
        return self::create($data);
    }

    public static function getTeamName($teamId) {
        return self::where('id',$teamId)->get()->first()->name;
    }

    public static function deleteTeam($id) {
        $team = self::find($id);
        return $team->delete();
    }

    public static function editTeam($data) {
        (new self())->validate($data);

        $team = Team::find($data['id']);
        if($team->name != $data['name']){
                $team->name = $data['name'];
            }
        if($team->manager != $data['manager']) {
                $team->manager = $data['manager'];
            }

        return $team->save();

    }

}
