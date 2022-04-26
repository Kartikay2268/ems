@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">


                    @if(Auth::user()->role == 'manager')
                    <div class="row">
                        <h4 style="text-align: center">Attendance Requests</h4>
                        <table class="table">
                            @if(!$requestData->isEmpty()))
                                @foreach($requestData as $data)
                                    <tr id="emp-{{$data->empId}}">
                                        <td>
                                            <b>Name:</b> {{$data->name}} ({{$data->empId}})<br>
                                            <b>Punch In:</b> {{$data->punchIn}} <br>
                                            <b>Punch Out:</b> {{$data->punchOut}}
                                        </td>
                                        <td>
                                            <button id="btn-approve" class="btn-success" onclick="approveAttendance({{$data->empId}})">Approve</button>
                                            <button id="btn-deny" class="btn-danger" onclick="denyAttendance({{$data->empId}})">Deny</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h5 style="text-align: center">No requests, please try refreshing the page!</h5>
                            @endif
                        </table>
                    </div>
                    @else
                        You are logged in! <br>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        function approveAttendance(empId) {
            var url = "http://localhost:8080/attendance/approve/" + empId;
            var xhr = new XMLHttpRequest();
            xhr.open('GET',url);
            xhr.send();
            id = "emp-"+empId
            document.getElementById(id).remove();
        }

        function denyAttendance(empId) {
            var url = "http://localhost:8080/attendance/deny/" + empId;
            var xhr = new XMLHttpRequest();
            xhr.open('GET',url);
            xhr.send();
            id = "emp-"+empId
            document.getElementById(id).remove();
        }
    </script>
@endsection
