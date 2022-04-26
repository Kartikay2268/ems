@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Salary
                        @if(Auth::user()->role == 'admin')
                            <button onclick="window.location='{{route('employees')}}'" style="float: right">Back</button>
                        @elseif(Auth::user()->role == 'manager')
                            <button onclick="window.location='{{route('managerTeam')}}'" style="float: right">Back</button>
                        @endif
                    </div>
                    <div class="panel-body">
                        <form method="post" action="{{route('salaryUpdate')}}">
                            <!-- Errors -->
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
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
                            <div class="form-group{{ $errors->has('fixed') ? ' has-error' : '' }}">
                                @if ($errors->has('fixed'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('fixed') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('variable') ? ' has-error' : '' }}">
                                @if ($errors->has('variable'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('variable') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('ctc') ? ' has-error' : '' }}">
                                @if ($errors->has('ctc'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('ctc') }}</strong>
                                </span>
                                @endif
                            </div>

                            {{csrf_field()}}
                            <table class="table">
                                <tr class="row">
                                    <th><label for="name">Name</label></th>
                                    <td><input id="name" type="text" name="name" value="{{$user->name}}" readonly></td>
                                </tr>
                                <tr class="row">
                                    <th><label for="empId">Id</label></th>
                                    <td><input id="empId" type="text" name="empId" value="{{$user->empId}}" readonly></td>
                                </tr>

                                    <tr class="row">
                                        <th><label for="fixed">Fixed (per month)</label></th>
                                        <td><input id="fixed" type="number" name="fixed" placeholder="Fixed Salary"
                                                   @if(isset($salary->fixed)) value="{{$salary->fixed}}" @endif
                                                   @if(Auth::user()->role == 'manager') readonly @endif></td>
                                    </tr>

                                    <tr class="row">
                                        <th><label for="variable">Variable (Upto 4000)</label></th>
                                        <td><input id="variable" type="number" name="variable" placeholder="Variable"
                                                   @if(isset($salary->variable)) value="{{$salary->variable}}" @endif ></td>
                                    </tr>

                                    <tr class="row">
                                        <th><label for="ctc">CTC (LPA)</label></th>
                                        <td><input id="ctc" type="string" name="ctc" placeholder="CTC"
                                                   @if(isset($salary->ctc)) value="{{$salary->ctc}}" @endif
                                                   @if(Auth::user()->role == 'manager') readonly @endif></td>
                                    </tr>

                                    <tr class="row">
                                        <th><button type="submit" class="btn-primary">Submit</button></th>
                                        <td></td>
                                    </tr>
                            </table>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection