<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'empId',
        'role',
        'designation',
        'phone',
        'address',
        'bloodGroup',
        'dob',
        'doj'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    private function validate($data) {
        if (empty($data)) {
            throw new \Exception("Invalid Parameters Passed");
        }
    }

    public static function addEmployee($data) {
        (new self())->validate($data);

        return self::create($data);
    }

    public static function editEmployee($data, $empId) {

        $id = self::where('empId', $empId)->get()->first()->id;
        $oldUser = self::where('id',$id)->get()->first();

        $user = self::find($id);

        if ($data['name'] != $oldUser->name) {
            $user->name = $data['name'];
        }
        if ($data['email'] != $oldUser->email) {
            $user->email = $data['email'];
        }
        if ($data['password'] != $oldUser->password) {
            $user->password = bcrypt($data['password']);
        }
        if ($data['empId'] != $oldUser->empId) {
            $user->empId = $data['empId'];
        }
        if ($data['role'] != $oldUser->role) {
            $user->role = $data['role'];
        }
        if ($data['phone'] != $oldUser->phone) {
            $user->phone = $data['phone'];
        }
        if ($data['designation'] != $oldUser->designation) {
            $user->designation = $data['designation'];
        }
        if ($data['address'] != $oldUser->address) {
            $user->address = $data['address'];
        }
        if ($data['name'] != $oldUser->bloodGroup) {
            $user->bloodGroup = $data['name'];
        }
        if ($data['dob'] != $oldUser->dob) {
            $user->dob = $data['dob'];
        }
        if ($data['doj'] != $oldUser->doj) {
            $user->doj = $data['doj'];
        }

        return $user->save();

    }

    public static function deleteEmployee($empId) {
        return self::where('empId', $empId)->delete();
    }

    public static function getEmployees() {
        return self::paginate(5);
    }

    public static function getName($empId) {
        return self::where('empId', $empId)->first()->name;
    }

    public static function getTeamMembers ($teamId) {
        return self::where('team_id',$teamId)->paginate(5);
    }

    public static function getUser($empId) {
        return self::where('empId', $empId)->get();
    }

    public static function getManagers() {
        return self::where('role','manager')->get();
    }

    public static function getFreeEmployees() {
        return self::where('role','emp')->whereNull('team_id')->get();
    }

    public static function setTeam($empId, $teamId) {
        $id = self::where('empId', $empId)->first()->id;
        $user = self::find($id);
        $user->team_id = $teamId;
        return $user->save();
    }

    public static function unsetTeam($empId) {
        $id = self::where('empId', $empId)->first()->id;
        $user = self::find($id);
        $user->team_id = NULL;
        return $user->save();
    }

    public static function getUsers($role) {
        return self::where('role', $role)->paginate(5);
    }


}
