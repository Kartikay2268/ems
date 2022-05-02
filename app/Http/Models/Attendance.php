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
    private function validate($data)
    {
        if (empty($data)) {
            throw new \Exception("Invalid Parameters Passed");
        }
    }

    /**
     * @param $attendanceInfo
     * @return Attendance|bool|Model
     * @throws \Exception
     */

    public static function punchIn($attendanceInfo)
    {
        (new self())->validate($attendanceInfo);

        return self::updateOrCreate([
            'empId' => $attendanceInfo['empId']
        ], $attendanceInfo);


    }

    /**
     * @param $attendanceInfo
     * @return Model
     * @throws \Exception
     */

    public static function punchOut($attendanceInfo)
    {

        (new self())->validate($attendanceInfo);

        return self::updateOrCreate([
            'empId' => $attendanceInfo['empId']
        ], $attendanceInfo);
    }

    public static function getPunchTime($empId)
    {

        return self::where('empId', $empId)->first();

    }

    public static function getRequestData($managerId)
    {
        return self::where([
            ['manager_id','=',$managerId],
            ['request', '=', 1]
        ])->get(['punchIn', 'punchOut', 'empId']);

    }

    public static function approveAttendance($empId)
    {
        $id = self::where('empId', $empId)->first()->id;
        $attendance = self::find($id);
        $attendance->request = 0;
        $attendance->working_days = $attendance->working_days + 1;
        return $attendance->save();
    }

    public static function denyAttendance($empId)
    {
        $id = self::where('empId', $empId)->first()->id;
        $attendance = self::find($id);
        $attendance->request = 0;
        return $attendance->save();
    }

    public static function clearPunchTimes() {
        $attendance = Attendance::query();
        $attendance->update(['punchIn' => null, 'punchout' => null]);
    }


}
