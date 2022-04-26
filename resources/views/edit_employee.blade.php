@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Employee
                        <button onclick="window.location='{{route('employees')}}'" style="float: right">Back</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="post" action="{{route('employee.update')}}">
                                {{csrf_field()}}
                                <table class="table">
                                    <tr class="row">
                                        <th><label for="name">Name</label></th>
                                        <td ><input id="name" name="name" type="text" placeholder="Name" value="{{htmlspecialchars($user->name)}}"></td>
                                    </tr>
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <tr class="row">
                                        <th><label for="email">Email</label></th>
                                        <td><input id="email" name="email" type="email" placeholder="Email" value="{{htmlspecialchars($user->email)}}"></td>
                                    </tr>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('empId') ? ' has-error' : '' }}">
                                        @if ($errors->has('empId'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('empId') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('designation') ? ' has-error' : '' }}">
                                        @if ($errors->has('designation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('designation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                        @endif
                                    </div><div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('bloodGroup') ? ' has-error' : '' }}">
                                        @if ($errors->has('bloodGroup'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('bloodGroup') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                                        @if ($errors->has('dob'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('doj') ? ' has-error' : '' }}">
                                        @if ($errors->has('doj'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('doj') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <tr class="row">
                                        <th><label for="password">Password</label></th>
                                        <td><input id="password" name="password" type="password" placeholder="Password" value="{{htmlspecialchars($user->password)}}"></td>
                                    </tr>
                                    <tr class="row">
                                        <th><label for="empId">Id</label></th>
                                        <td><input id="empId" name="empId" type="text" placeholder="Employee Id" value="{{htmlspecialchars($user->empId)}}"></td>
                                    </tr>
                                    <tr class="row">
                                        <th><label for="role">Role</label></th>
                                        <td>
                                            <select id="role" name="role">
                                                @if($user->role == "emp")
                                                    <option value="emp" selected>Employee</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="admin">Admin</option>
                                                @elseif($user->role == "manager")
                                                    <option value="manager" selected>Manager</option>
                                                    <option value="emp">Employee</option>
                                                    <option value="admin">Admin</option>
                                                @elseif($user->role == "admin")
                                                    <option value="admin" selected>Admin</option>
                                                    <option value="emp">Employee</option>
                                                    <option value="manager">Manager</option>
                                                @else
                                                    <option hidden selected>Choose your option</option>
                                                    <option value="emp">Employee</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="admin">Admin</option>
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <th><label for="designation">Designation</label></th>
                                        <td><input id="designation" name="designation" type="text" placeholder="Designation" value="{{htmlspecialchars($user->designation)}}"></td>
                                    </tr>
                                    <tr class="row">
                                        <th><label for="phone">Contact Number</label></th>
                                        <td><input id="phone" name="phone" type="text" placeholder="Contact Number" value="{{htmlspecialchars($user->phone)}}"></td>
                                    </tr>
                                    <tr class="row">
                                        <th><label for="address">Address</label></th>
                                        <td><textarea id="address" name="address" placeholder="Street, City, Country">{{htmlspecialchars($user->address)}}</textarea></td>
                                    </tr>
                                    <tr class="row">
                                        <th><label for="bloodGroup">Blood Group</label></th>
                                        <td><input id="bloodGroup" name="bloodGroup" type="text" placeholder="BloodGroup" value="{{htmlspecialchars($user->bloodGroup)}}"></td>
                                    </tr>
                                    <tr class="row">
                                        <th><label for="dob">Date of Birth</label></th>
                                        <td><input id="dob" name="dob" type="text" placeholder="YYYY-MM-DD" value="{{htmlspecialchars($user->dob)}}"></td>
                                    </tr>
                                    <tr class="row">
                                        <th><label for="doj">Date of Joining</label></th>
                                        <td><input id="doj" name="doj" type="text" placeholder="YYYY-MM-DD" value="{{htmlspecialchars($user->doj)}}"></td>
                                    </tr>
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