<?php

namespace App\Http\Controllers;

use App\Http\Models\Attendance;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::guest()) {
            return view('login');
        }

        $requestData = null;

        if (Auth::user()->role == 'manager') {

            try {
                $requestData = Attendance::getRequestData(Auth::user()->empId);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }

            if (!$requestData->isEmpty()) {
                foreach ($requestData as $data) {

                    try {
                        $data->name = User::getName($data->empId);
                    } catch (\Exception $exception) {
                        return $exception->getMessage();
                    }
                }
            }
        }
        return view('home', ['requestData' => $requestData]);


    }

}
