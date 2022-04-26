@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">


                    <div class="panel-heading"><b>{{$teamName}}</b></div>

                    <div class="row">
                        <table class="table">
                            <thead>
                            <th style="text-align: center; width: 80px;">Name</th>
                            <th style="text-align: center; width: 80px;">Id</th>
                            <th style="text-align: center; width: 80px;">Designation</th>
                            <th style="text-align: center; width: 150px;">Action</th>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td style="text-align: center; width: 80px;">
                                        <a href="{{route('viewMember', $member->empId)}}">{{$member->name}}</a>
                                    </td>
                                    <td style="text-align: center; width: 80px;">
                                        {{$member->empId}}
                                    </td>
                                    <td style="text-align: center; width: 80px;">
                                        {{$member->designation}}
                                    </td>
                                    <td class="dropdown" style="text-align: center">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Select an Action<span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{route('viewMember', $member->empId)}}">
                                                    View
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('salaryDetails', $member->empId)}}">
                                                    Salary Details
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$members->links()}}
                    </div>

                    <div class="panel-body">



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection