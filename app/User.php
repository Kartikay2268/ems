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

    private function validate($data)
    {
        if (empty($data)) {
            throw new \Exception("Invalid Parameters Passed");
        }
    }

    public static function addEmployee($employeeInfo)
    {
        (new self())->validate($employeeInfo);

        return self::create($employeeInfo);
    }

    public static function editEmployee($employeeInfo, $empId)
    {

        (new self())->validate($employeeInfo);

        $id = self::where('empId', $empId)->get()->first()->id;
        $oldUser = self::where('id', $id)->get()->first();

        $user = self::find($id);

        if ($employeeInfo['name'] != $oldUser->name) {
            $user->name = $employeeInfo['name'];
        }
        if ($employeeInfo['email'] != $oldUser->email) {
            $user->email = $employeeInfo['email'];
        }
        if ($employeeInfo['password'] != $oldUser->password) {
            $user->password = bcrypt($employeeInfo['password']);
        }
        if ($employeeInfo['empId'] != $oldUser->empId) {
            $user->empId = $employeeInfo['empId'];
        }
        if ($employeeInfo['role'] != $oldUser->role) {
            $user->role = $employeeInfo['role'];
        }
        if ($employeeInfo['phone'] != $oldUser->phone) {
            $user->phone = $employeeInfo['phone'];
        }
        if ($employeeInfo['designation'] != $oldUser->designation) {
            $user->designation = $employeeInfo['designation'];
        }
        if ($employeeInfo['address'] != $oldUser->address) {
            $user->address = $employeeInfo['address'];
        }
        if ($employeeInfo['name'] != $oldUser->bloodGroup) {
            $user->bloodGroup = $employeeInfo['name'];
        }
        if ($employeeInfo['dob'] != $oldUser->dob) {
            $user->dob = $employeeInfo['dob'];
        }
        if ($employeeInfo['doj'] != $oldUser->doj) {
            $user->doj = $employeeInfo['doj'];
        }

        return $user->save();

    }

    public static function deleteEmployee($empId)
    {
        return self::where('empId', $empId)->delete();
    }

    public static function getEmployees()
    {
        return self::paginate(10);
    }

    public static function getName($empId)
    {
        return self::where('empId', $empId)->first()->name;
    }

    public static function getTeamMembers($teamId)
    {
        return self::where('team_id', $teamId)->paginate(10);
    }

    public static function getUser($empId)
    {
        return self::where('empId', $empId)->get();
    }

    public static function getManagers()
    {
        return self::where('role', 'manager')->get();
    }

    public static function getFreeEmployees()
    {
        return self::where('role', 'emp')->whereNull('team_id')->get();
    }

    public static function setTeam($empId, $teamId)
    {
        $id = self::where('empId', $empId)->first()->id;
        $user = self::find($id);
        $user->team_id = $teamId;
        return $user->save();
    }

    public static function unsetTeam($empId)
    {
        $id = self::where('empId', $empId)->first()->id;
        $user = self::find($id);
        $user->team_id = NULL;
        return $user->save();
    }

    public static function getUsers($role)
    {
        return self::where('role', $role)->paginate(10);
    }

    public static function filterExperience($exp) {
        return self::where('experience', $exp)->paginate(10);
    }

    public static function filter($role, $exp) {
        return self::where([
            ['experience','=', $exp],
            ['role','=', $role]
        ])->paginate(10);
    }


}
