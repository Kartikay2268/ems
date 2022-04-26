<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EMS') }}</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>


</head>
<body>
    <div>

        <div class="d-flex justify-content-center">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">{{config('app.name','EMS')}} Attendance</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                            </li>
                            <div class="d-flex justify-content-end">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Apply
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#" role="button"
                                               data-bs-toggle="modal" data-bs-target="#attendanceModal">Mark Attendance</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#"role="button"
                                               data-bs-toggle="modal" data-bs-target="#leaveModal">Apply Leave</a></li>
                                    </ul>
                                </li>

                            </div>


                        </ul>

                    </div>
                </div>
            </nav>

        </div>
    </div>

        <!-- Attendance Modal -->
        <div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="attendanceModalLabel">Mark Attendance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="form" method="get">
                            <div id="Help" class="form-text">Select the range within a week only</div>
                            <div class="mb-3">
                                <label for="from_date" class="form-label">From Date</label>
                                <input type="text" class="form-control" name="fromDate"
                                       placeholder="YYYY-MM-DD" id="from_date" aria-describedby="dateHelp">
                            </div>
                            <div class="mb-3">
                                <label for="to_date" class="form-label">To Date</label>
                                <input type="text" class="form-control" name="toDate"
                                       placeholder="YYYY-MM-DD" id="to_date" aria-describedby="dateHelp">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>


        <!-- Leave Modal-->
        <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="leaveModalLabel">Apply Leaves</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="form" method="post">

                            <div class="mb-3">
                                <label for="leavetype" class="form-label">Leave Type</label>
                                <select id="leavetype" name="type" class="form-control">
                                    <option value="cl">Casual Leave</option>
                                    <option value="al">Annual Leave</option>
                                    <option value="sl">Sick Leave</option>
                                </select>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="halfDay" name="halfDay" value="halfDayMarked">
                                <label class="form-check-label" for="HalfDay" aria-describedby="halfDayHelp">Half Day</label>
                                <div id="Help" class="form-text">Only Casual Leaves can be used to apply Half Day</div>
                            </div>

                            <div class="mb-3">
                                <label for="from_date" class="form-label">From Date</label>
                                <input type="text" class="form-control" name="fromDate"
                                       placeholder="YYYY-MM-DD" id="from_ldate" aria-describedby="dateHelp">
                            </div>
                            <div class="mb-3">
                                <label for="to_date" class="form-label">To Date</label>
                                <input type="text" class="form-control" name="toDate"
                                       placeholder="YYYY-MM-DD" id="to_ldate" aria-describedby="dateHelp">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <input type="text" class="form-control" name="message" placeholder="Enter a message" id="message">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>

    <div class="container">

        <div class="d-flex flex-column bd-highlight mb-3 justify-content-md-evenly">

            <br><br>

            <div class="container">
                Date: {{date('Y-m-d')}}
            </div>

            <br><br>

            <div class="container" >

                    <button type="button" class="btn btn-primary">Punch In</button>

                    &nbsp;

                    <button type="button" class="btn btn-danger">Punch Out</button>
            </div>

            <br><br>

            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>



    <script>
        $( "#from_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        $( "#to_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        $( "#from_ldate" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        $( "#to_ldate" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    </script>
</body>