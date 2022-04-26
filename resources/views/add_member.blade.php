@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$name}}
                        <button onclick="window.location='{{url()->previous()}}'" style="float: right">Back</button></div>

                    <div class="panel-body">

                        <div class="row" style="margin-left: 30%">

                            <form method="post" action="{{route('teams.addMemberSubmit')}}">
                                {{csrf_field()}}
                                <input hidden name="team_id" value="{{$team_id}}">
                                <div class="row">
                                    <select id="member_id" name="member_id">
                                        <option hidden>Choose Member</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->empId}}">{{$employee->name}} ({{$employee->designation}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn-primary" style="margin-left: 25%">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection