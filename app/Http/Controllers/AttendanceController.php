<?php

namespace App\Http\Controllers;

use App\Http\Models\Attendance;
use App\Http\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {

        $punchIn = null;
        $punchOut = null;
        $currentDate = date('d/m/y');

        try {
            $attendanceInfo = Attendance::getPunchTime(Auth::user()->empId);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        if (!empty($attendanceInfo)) {

            $punchInDate = substr($attendanceInfo->punchIn, 0, 8);
            $punchOutDate = substr($attendanceInfo->punchOut, 0, 8);

            if (!empty($attendanceInfo->punchIn) && $currentDate == $punchInDate) {
                $punchIn = $attendanceInfo->punchIn;
            }

            if (!empty($attendanceInfo->punchOut) && $currentDate == $punchOutDate) {
                $punchOut = $attendanceInfo->punchOut;
            }
        }

        return view('employee.attendance', ['punchIn' => $punchIn, 'punchOut' => $punchOut]);
    }


    public function punchIn()
    {

        try {
            $managerId = Team::getManagerId(Auth::user()->team_id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $attendanceInfo = [
            'punchIn' => date('d/m/y H:i:s'),
            'empId' => Auth::user()->empId,
            'time' => time(),
            'manager_id' => $managerId
        ];

        try {
            Attendance::punchIn($attendanceInfo);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect(route('attendance'));
    }

    public function punchOut()
    {

        $attendanceInfo = [
            'punchOut' => date('d/m/y H:i:s'),
            'empId' => Auth::user()->empId,
            'request' => 1
        ];

        try {
            Attendance::punchOut($attendanceInfo);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect(route('attendance'));

    }

    public function approveAttendance(Request $request)
    {
        try {
            Attendance::approveAttendance($request->id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function denyAttendance(Request $request)
    {
        try {
            Attendance::denyAttendance($request->id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
