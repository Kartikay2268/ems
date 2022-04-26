@extends('layouts.app')
@section('content')
    <div class="container" style="font-family: sans-serif">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Attendance</div>

                    <div class="panel-body">

                        <form method="post">

                            <div class="container">
                                <p id="datetime"></p>

                            </div>

                            <table class="table">
                                <tr style=" text-align: right">
                                    <th>Punch In Attendance</th>
                                    <td ><button type="button" id="inbutton" class="btn-primary" onclick="setPunchIn()">Punch In</button></td>
                                </tr>
                                <tr style=" text-align: right">
                                    <th>Punch Out Attendance</th>
                                    <td><button type="button" id="outbutton" class="btn-danger" onclick="setPunchOut()">Punch Out</button></td>
                                </tr>
                                <tr style="text-align: right">
                                    <th>Punch In Time</th>
                                    <td>
                                        <p id="punchin">{{$punchIn}}</p>
                                    </td>
                                </tr>
                                <tr style="text-align: right">
                                    <th>Punch Out Time</th>
                                    <td>
                                        <p id="punchout">{{$punchOut}}</p>
                                    </td>
                                </tr>
                            </table>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //var csrf = document.querySelector('meta[name="csrf-token"]').content;
        if(document.getElementById('punchin').innerHTML !== ""){
            document.getElementById('inbutton').disabled = true;
            document.getElementById('outbutton').disabled = false;
        }

        if(document.getElementById('punchin').innerHTML !== "" && document.getElementById('punchout').innerHTML !== ""){
            document.getElementById('outbutton').disabled = true;
            document.getElementById('inbutton').disabled = true;
        }

        setInterval(settime, 1000);

        function settime() {
            var d = new Date();
            document.getElementById('datetime').innerHTML =d.toString().slice(0, 24);
        }

        function setPunchIn() {
            // var d = new Date();
            // var str = "Punched In: " + d.toString().slice(0, 24);
            // var text = document.createTextNode(str);
            // var url = "http://localhost:8080/attendance/punchIn/" + d.toString().slice(0, 24);
            // document.getElementById('punchin').appendChild(text);
            document.getElementById('inbutton').disabled = true;
            window.location='{{ route("attendance.punchIn")}}';
            // var xhr = new XMLHttpRequest();
            // xhr.open('GET',url);
            // xhr.send();
            // console.log("sent");

        }

        function setPunchOut() {
            // var d = new Date();
            // var str = "Punched Out: " + d.toString().slice(0, 24);
            // var text = document.createTextNode(str);
            // var url = "http://localhost:8080/attendance/punchOut/" + d.toString().slice(0, 24);
            // document.getElementById('punchout').appendChild(text);
            document.getElementById('outbutton').disabled = true;
            window.location='{{ route("attendance.punchOut")}}';

            // var xhr = new XMLHttpRequest();
            // xhr.open('GET',url);
            // xhr.send();
            // console.log("sent");
        }
    </script>
@endsection