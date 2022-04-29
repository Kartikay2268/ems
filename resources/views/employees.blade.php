@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Employees
                    <button class="button-add" onclick="window.location='{{ route("employee.add") }}'">Add</button></div>

                    <div class="panel-body">

                        <div class="row">
                        <form method="get" class="filter-form" action="{{route('employee.filter')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-sm-12">
                                <label for="exp">Experience</label><br>
                                <input id="exp" type="number" placeholder="Experience (years)" name="exp">
                            </div>
                            <div>
                                <label for="role">Role</label><br>
                                <select name="role">
                                    <option hidden>Choose Role</option>
                                    <option value="emp">Employee</option>
                                    <option value="manager">Manager</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="button-add">Filter</button>
                            </div>
                            <div>
                                <button class="button-add" onclick="window.location='{{ route("employees") }}'">Reset</button>
                            </div>
                        </form>
                        </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr role="row">
                                    <th style="text-align: center; width: 150px;">Action</th>
                                    <th style="text-align: center; width: 60px;">Name</th>
                                    <th style="text-align: center; width: 60px;">Id</th>
                                    <th style="text-align: center; width: 60px;">Designation</th>
                                    <th style="text-align: center; width: 60px;">Role</th>
                                    <th style="text-align: center; width: 150px;">Experience</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr role="row">
                                        <td class="dropdown" style="text-align: center">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                Select an Action<span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="{{ route('employee.edit',$user->empId) }}">
                                                        Edit
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{route('salaryDetails', $user->empId)}}">
                                                        Salary Details
                                                    </a>

                                                </li>
                                                <li>
                                                    <form method="post" action="{{ route('employee.delete',$user->empId) }}">
                                                        {{method_field('DELETE')}}
                                                        {{csrf_field()}}
                                                        <button type="submit"
                                                                style="border: none; background: #ffffff; color: #ff3025;
                                                                align-content: center; width: 85px;"><b>Delete</b></button>
                                                    </form>
                                                    <!--<a href="{{ route('employee.delete',$user->empId) }}">
                                                        Delete
                                                    </a>-->

                                                </li>
                                            </ul>
                                        </td>
                                        <td style="text-align: center">
                                            {{$user->name}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$user->empId}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$user->designation}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$user->role}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$user->doj}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div style="margin-right: 10px; float: right">
                                {{ $users->appends(Request::except('page'))->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection