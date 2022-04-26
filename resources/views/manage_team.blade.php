@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$name}}
                        <button style="margin-left: 20px; width: 150px;" class="button-add" onclick="window.location='{{route('teams.addMember', $team_id)}}'">Add Member</button>
                        <button class="button-add" onclick="window.location='{{route('teams')}}'">Back</button></div>
                    <div class="panel-body">
                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="text-align: center; width: 60px;">Name</th>
                                    <th style="text-align: center; width: 60px;">Id</th>
                                    <th style="text-align: center; width: 60px;">Designation</th>
                                    <th style="text-align: center; width: 100px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr role="row">
                                        <td style="text-align: center">
                                            {{$member->name}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$member->empId}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$member->designation}}
                                        </td>
                                        <td class="dropdown" style="text-align: center">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                Select an Action<span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="{{route('teams.deleteMember', [$team_id, $member->empId])}}">
                                                        Delete
                                                    </a>

                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection