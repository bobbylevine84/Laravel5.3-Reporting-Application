@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="text-align: center;">
        <h4>Weekly Overview</h4>
    </div>
    <div class="row">
      <div style="float: left;">
        <div id="systems_chart"></div>
        <h5 style="margin-left: 160px;">Systems</h5>
      </div>
      <div style="float: left;">
        <div id="rooms_chart"></div>
        <h5 style="margin-left: 170px;">Rooms</h5>
      </div>
      <div style="float: left;">
        <div id="cashiers_chart"></div>
        <h5 style="margin-left: 140px;">Cashiers</h5>
      </div>
    </div>
</div>
<script type="text/javascript">

google.charts.load('current', {'packages':['line', 'corechart']});

google.charts.setOnLoadCallback(drawChart);

function drawChart() {

 var systems_data = google.visualization.arrayToDataTable([
          ['Systems', 'Percent'],
          @foreach($systems as $data => $system)
          ['{!! $system->name !!}', 2],
          @endforeach
        ]);

 var systems_options = {
   legend: {position: 'top', textStyle: {color: 'black', fontSize: 11}},
   chartArea: {width: "65%", height: "70%", top: 60, left: 60},
   is3D: true,
   width: 380,
   height: 300,
 };

 var systems_chart = new google.visualization.PieChart(document.getElementById('systems_chart'));
 systems_chart.draw(systems_data, systems_options);

 var rooms_data = google.visualization.arrayToDataTable([
          ['System', 'R1', 'R2', 'R3'],
          ['G1', 1000, 400, 200],
          ['G2', 1170, 460, 250],
          ['G3', 660, 1120, 300],
        ]);

 var rooms_options = {
   width: 380,
   height: 300
 };

 var rooms_chart = new google.visualization.ColumnChart(document.getElementById('rooms_chart'));

 rooms_chart.draw(rooms_data, rooms_options);

 var cashiers_data = google.visualization.arrayToDataTable([
          ['', 'C1', 'C2', 'C3'],
          ['10',  20, 50, 40],
          ['20',  80, 20, 60],
          ['30',  30, 100, 80],
        ]);

 var cashiers_options = {
   width: 380,
   height: 300,
 };

 var cashiers_chart = new google.charts.Line(document.getElementById('cashiers_chart'));

 cashiers_chart.draw(cashiers_data, cashiers_options);
}
</script>
@endsection
