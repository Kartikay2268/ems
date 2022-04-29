@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Teams
                        <button class="button-add" onclick="window.location='{{ route("teams.add") }}'">Add</button></div>

                    <div class="panel-body">

                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr role="row">
                                    <th style="text-align: center; width: 80px;">Action</th>
                                    <th style="text-align: center; width: 60px;">Name</th>
                                    <th style="text-align: center; width: 60px;">Manager Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teams as $team)
                                    <tr role="row">
                                        <td class="dropdown" style="text-align: center">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                Select an Action<span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="{{route('teams.manage', $team->id)}}">
                                                        Manage Team
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('teams.editTeam', $team->id)}}">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>

                                                    <form method="post" action="{{route('teams.deleteTeam', $team->id)}}">
                                                        {{method_field('DELETE')}}
                                                        {{csrf_field()}}
                                                        <button type="submit"
                                                                style="border: none; background: #ffffff; color: #ff3025;
                                                                align-content: center; width: 85px;"><b>Delete</b></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{route('teams.manage', $team->id)}}">{{$team->name}}</a>
                                        </td>
                                        <td style="text-align: center">
                                            {{$team->managerName}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="margin-right: 10px; float: right">
                                {{$teams->links()}}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection