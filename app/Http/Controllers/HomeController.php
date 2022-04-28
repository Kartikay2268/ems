<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

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
