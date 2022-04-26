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
        if(Auth::guest()){
            return view('login');
        }

        $requestData = null;

        if(Auth::user()->role == 'manager') {

            $requestData  = Attendance::getRequestData(Auth::user()->empId);
            if($requestData->isEmpty()) {
                foreach ($requestData as $data) {
                    $data->name =  User::getName($data->empId);
                }
            }
        }
        return view('home', ['requestData' => $requestData]);



    }

}
