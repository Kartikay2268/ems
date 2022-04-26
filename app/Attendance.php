<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'empId',
        'punchIn',
        'punchOut',
        'time',
        'manager_id',
        'working_days',
        'request'
    ];

    /**
     * @param $data
     * @return void
     * @throws \Exception
     */
    private function validate($data) {
        if(empty($data)) {
            throw new \Exception("Invalid Parameters Passed");
        }
    }

    /**
     * @param $data
     * @return Attendance|bool|Model
     * @throws \Exception
     */

    public static function punchIn($data) {
        (new self())->validate($data);

        return self::updateOrCreate( [
            'empId' => $data['empId']
        ], $data);


    }

    /**
     * @param $data
     * @return Model
     * @throws \Exception
     */

    public static function punchOut($data) {

        (new self())->validate($data);

        return self::updateOrCreate( [
            'empId' => $data['empId']
        ], $data);
    }

    public static function getPunchTime($empId) {

        return self::where('empId', $empId)->first();

    }

    public static function getRequestData($managerId) {

        return self::where('manager_id', $managerId)->where('request', 1)->get(['punchIn', 'punchOut', 'empId']);

    }

    public static function approveAttendance($empId) {
        $attendance = self::find(self::where('empId', $empId)->first()->id);
        $attendance->request = 0;
        $attendance->working_days = $attendance->working_days + 1;
        return $attendance->save();
    }

    public static function denyAttendance($empId) {
        $attendance = self::find(self::where('empId', $empId)->first()->id);
        $attendance->request = 0;
        return $attendance->save();
    }

}
