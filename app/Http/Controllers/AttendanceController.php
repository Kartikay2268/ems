<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use App\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index() {
        date_default_timezone_set('Asia/Kolkata');

        $punchIn = null;
        $punchOut = null;
        $date = date('d/m/y');

        $attendance = Attendance::getPunchTime(Auth::user()->empId);

        if (!empty($attendance)) {

            if (!empty($attendance->punchIn && $date == substr($attendance->punchIn, 0, 8))) {
                $punchIn = $attendance->punchIn;
            }

            if (!empty($attendance->punchOut && $date == substr($attendance->punchOut, 0, 8))) {
                $punchOut = $attendance->punchOut;
            }
        }

        return view('employee.attendance', ['punchIn' => $punchIn, 'punchOut' => $punchOut]);
    }


    public function punchIn(){
        date_default_timezone_set('Asia/Kolkata');

        $manager = Team::where('id', Auth::user()->team_id)->first()->manager;

        $data = ['punchIn'=> date('d/m/y H:i:s'),
                'empId' => Auth::user()->empId,
                'time' => time(),
                'manager_id' => $manager
        ];

        try {
            Attendance::punchIn($data);
            return redirect(route('attendance'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function punchOut() {
        date_default_timezone_set('Asia/Kolkata');

        $data = ['punchOut'=> date('d/m/y H:i:s'),
                'empId' => Auth::user()->empId,
                'request' => 1
        ];

        try {
            Attendance::punchOut($data);
            return redirect(route('attendance'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function approveAttendance(Request $request) {
        try {
            Attendance::approveAttendance($request->id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function denyAttendance(Request $request) {
        try {
            Attendance::denyAttendance($request->id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
