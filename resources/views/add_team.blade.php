@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Team
                        <button onclick="window.location='{{route('teams')}}'" style="float: right">Back</button>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <form method="post" action="{{route('teams.submit')}}">
                                {{csrf_field()}}
                                <table class="table">
                                    <tr class="row">
                                        <th><label for="team_name">Name</label></th>
                                        <td ><input id="team_name" name="team_name" type="text" placeholder="Name"></td>
                                    </tr>
                                    <div class="form-group{{ $errors->has('team_name') ? ' has-error' : '' }}">
                                        @if ($errors->has('team_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('team_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <tr class="row">
                                        <th><label for="team_manager">Manager</label></th>
                                        <td>
                                            <select id="team_manager" name="team_manager">
                                                <option hidden>Choose Manager</option>
                                                @foreach($managers as $manager)
                                                    <option value="{{$manager->empId}}">{{$manager->name}} ({{$manager->designation}})</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <div class="form-group{{ $errors->has('team_manager') ? ' has-error' : '' }}">
                                        @if ($errors->has('team_manager'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('team_manager') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </table>
                                <button type="submit" class="btn-primary" style="margin-left: 30px">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection