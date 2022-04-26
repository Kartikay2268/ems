@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Employee Details</div>
                    <div class="panel-body">
                        <table class="table">
                            @foreach($users as $user)
                                <tr>
                                    <th>Name</th>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th>Employee ID</th>
                                    <td>{{$user->empId}}</td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>{{$user->designation}}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{$user->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>{{$user->dob}}</td>
                                </tr>
                                <tr>
                                    <th>Date of Joining</th>
                                    <td>{{$user->doj}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{$user->address}}</td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>{{$user->role}}</td>
                                </tr>
                                <tr>
                                    <th>Blood Group</th>
                                    <td>{{$user->bloodGroup}}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <th>CTC (LPA)</th>
                                    <td>
                                        @if(isset($salary->ctc))
                                            {{$salary->ctc}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                            @if(Auth::user()->role == 'emp')

                                    <tr>
                                        <th>Team</th>
                                        <td>
                                            @if(isset($team->name))
                                                {{$team->name}}
                                            @else
                                                --
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Manager</th>
                                        <td>
                                            @if(isset($managerName))
                                                {{$managerName}}
                                            @else
                                                --
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection