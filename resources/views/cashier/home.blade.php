@extends('layouts.app')
{!! Html::style('css/cashierview.css') !!}
@section('content')
<div class="container">
    <div class="row">
        {!! $table->render() !!}
    </div>
</div>

{!! Form::open(['url' => route('cashier.addcash'), 'data-parsley-validate']) !!}
@if (!empty($selectedsysteminfo))
<input id="selectedsystem" name="selectedsystem" type="hidden" class="form-control" value = {!! $selectedsysteminfo->id !!}>
@endif
<div class="modal fade" id="addcashmodal" role="dialog">
  <div class="modal-dialog" id="addcashdialog">

    <!-- Modal content-->

    <div class="modal-content" id="modal-content">
      <div class="modal-header" id="modal-header">
        {!! Form::button('&times;', array('type' => 'button', 'id' => 'addcashclose', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
        Add
      </div>

      <div class="modal-body" id="modal-body">
        <div class="row">
          <div class="col-xs-3">
            <div class="input-group date">
              <input id="startdate" name="startdate" type="text" class="form-control">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>

          <div class="col-xs-3">
            <input id="starttime" name="starttime" class="form-control">
          </div>

          <div class="col-xs-3">
            <div class="input-group date">
              <input id="enddate" name="enddate" type="text" class="form-control">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>

          <div class="col-xs-3">
            <input id="endtime" name="endtime" class="form-control">
          </div>

        </div>

        <div class="row">
          <div class="col-xs-3" style="margin-left: 25px;">
            Start Date
          </div>
          <div class="col-xs-3" style="margin-left: -10px;">
            Start Time
          </div>
          <div class="col-xs-3" style="margin-left: 15px;">
            End Date
          </div>
          <div class="col-xs-2" style="margin-left: -15px;">
            End Time
          </div>
        </div>

        <br/>

        <div class="row">
          <div class="col-xs-3">
          </div>
          <div class="col-xs-3">
            <input id="InCash" name="InCash" class="form-control" value="0">
          </div>
          <div class="col-xs-3">
            <input id="OutCash" name="OutCash" class="form-control" value="0">
          </div>
          <div class="col-xs-3">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-3">
          </div>
          <div class="col-xs-3">
            <center>
              In
            </center>
          </div>
          <div class="col-xs-3">
            <center>
              Out
            </center>
          </div>
          <div class="col-xs-3">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-2">
          </div>
          <div class="col-xs-8" style="margin-top:10px;margin-bottom:10px;">
            <select class="form-control" name="systemlist" id="systemlist"
              @if (count($selectedsystem) == 1)
              disabled="true"
              @endif
            >
              @foreach($selectedsystem as $system => $value)
              <option value={!! $value->id !!}>{!! $value->name !!}</option>
              @endforeach
            </select>
            @if(count($selectedsystem) == 1)
              @foreach($selectedsystem as $system => $value)
              <input type="hidden" name="systemlist" value={!! $value->id !!} />
              @endforeach
            @endif
          </div>
          <div class="col-xs-2">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-2">
          </div>
          <div class="col-xs-8" id="roomlistdiv" style="margin-bottom:10px;">
            <select class="form-control" name="roomlist" id="roomlist">
            </select>
          </div>
          <div class="col-xs-2">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-2">
          </div>
          <div class="col-xs-8">
            {!! Form::button('Submit', array('type' => 'submit', 'id'=>'addbutton', 'class' => 'btn btn-default', 'style' => 'width:100%;height:25%;')) !!}
          </div>
          <div class="col-xs-2">
          </div>
        </div>

      </div>

      <div class="modal-footer" id="modal-footer">
      </div>

    </div>

  </div>
</div>
{!! Form::close() !!}

{!! Form::open(['url' => route('cashier.changecash'), 'data-parsley-validate']) !!}
@if (!empty($selectedsysteminfo))
<input id="selectedsystem" name="selectedsystem" type="hidden" class="form-control" value = {!! $selectedsysteminfo->id !!}>
@endif
<div class="modal fade" id="changecashmodal" role="dialog">
  <div class="modal-dialog" id="changecashdialog">

    <!-- Modal content-->

    <div class="modal-content" id="modal-content">
      <div class="modal-header" id="modal-header">
        {!! Form::button('&times;', array('type' => 'button', 'id' => 'changecashclose', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
        Change Request
      </div>

      <div class="modal-body" id="modal-body">
        <div class="row">
          <div class="col-xs-3">
            <div class="input-group date">
              <input id="changestartdate" name="changestartdate" type="text" class="form-control">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>

          <div class="col-xs-3">
            <input id="changestarttime" name="changestarttime" class="form-control">
          </div>

          <div class="col-xs-3">
            <div class="input-group date">
              <input id="changeenddate" name="changeenddate" type="text" class="form-control">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
            </div>
          </div>

          <div class="col-xs-3">
            <input id="changeendtime" name="changeendtime" class="form-control">
          </div>

        </div>

        <div class="row">
          <div class="col-xs-3" style="margin-left: 25px;">
            Start Date
          </div>
          <div class="col-xs-3" style="margin-left: -10px;">
            Start Time
          </div>
          <div class="col-xs-3" style="margin-left: 15px;">
            End Date
          </div>
          <div class="col-xs-2" style="margin-left: -15px;">
            End Time
          </div>
        </div>

        <br/>

        <div class="row">
          <div class="col-xs-3">
          </div>
          <div class="col-xs-3">
            <input id="changeInCash" name="changeInCash" class="form-control" value="0">
          </div>
          <div class="col-xs-3">
            <input id="changeOutCash" name="changeOutCash" class="form-control" value="0">
          </div>
          <div class="col-xs-3">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-3">
          </div>
          <div class="col-xs-3">
            <center>
              In
            </center>
          </div>
          <div class="col-xs-3">
            <center>
              Out
            </center>
          </div>
          <div class="col-xs-3">
          </div>
        </div>

        <input type="hidden" id="cashierdataid" name="cashierdataid">

        <div class="row">
          <div class="col-xs-2">
          </div>
          <div class="col-xs-8" style="margin-top:10px;margin-bottom:10px;">
            {!! Form::button('Request Delete', array('type' => 'submit', 'name' => 'deletebutton', 'formaction' => route('cashier.changecash', array('status' => 'delete')), 'class' => 'btn btn-default', 'style' => 'width:100%; height:5%;')) !!}
          </div>
          <div class="col-xs-2">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-2">
          </div>
          <div class="col-xs-8">
            {!! Form::button('Submit', array('type' => 'submit', 'name' => 'changebutton', 'formaction' => route('cashier.changecash', array('status' => 'modify')), 'class' => 'btn btn-default', 'style' => 'width:100%; height:5%;')) !!}
          </div>
          <div class="col-xs-2">
          </div>
        </div>

      </div>

      <div class="modal-footer" id="modal-footer">
      </div>

    </div>

  </div>
</div>
{!! Form::close() !!}

{!! Form::open(['url' => route('cashier.canceldeletecash'), 'data-parsley-validate']) !!}
@if (!empty($selectedsysteminfo))
<input id="selectedsystem" name="selectedsystem" type="hidden" class="form-control" value = {!! $selectedsysteminfo->id !!}>
@endif
<div class="modal fade" id="viewdeletecashmodal" role="dialog">
  <div class="modal-dialog" id="viewdeletecashdialog">

    <!-- Modal content-->

    <div class="modal-content" id="modal-content">
      <div class="modal-header" id="modal-header">
        {!! Form::button('&times;', array('type' => 'button', 'id' => 'viewdeletecashclose', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
        Delete Request
      </div>

      <div class="modal-body" id="modal-body">
        <div class="row">
          <div class="col-xs-4">
          </div>
          <div class="col-xs-6">
            Original Shift
          </div>
          <div class="col-xs-2">
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1">
          </div>
          <div class="col-xs-11">
            In: <span id="viewdeleteInCash"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1">
          </div>
          <div class="col-xs-11">
            Out: <span id="viewdeleteOutCash"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1">
          </div>
          <div class="col-xs-11">
            Shift Start Date: <span id="viewdeletestartdate"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1">
          </div>
          <div class="col-xs-11">
            Shift Start Time: <span id="viewdeletestarttime"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1">
          </div>
          <div class="col-xs-11">
            Shift End Date: <span id="viewdeleteenddate"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1">
          </div>
          <div class="col-xs-11">
            Shift End Time: <span id="viewdeleteendtime"></span>
          </div>
        </div>
        <br/>
        <input type="hidden" id="deletecashierdataid" name="deletecashierdataid">

        <div class="row">
          <div class="col-xs-1">
          </div>
          <div class="col-xs-5">
            {!! Form::button('OK', array('type' => 'button', 'name' => 'deletebutton', 'class' => 'btn btn-default', 'data-dismiss' => 'modal', 'style' => 'width:100%; height:5%;')) !!}
          </div>
          <div class="col-xs-5">
            {!! Form::button('Cancel', array('type' => 'submit', 'name' => 'canceldeletebutton', 'class' => 'btn btn-default', 'style' => 'width:100%; height:5%;')) !!}
          </div>
          <div class="col-xs-1">
          </div>
        </div>
      </div>

      <div class="modal-footer" id="modal-footer">
      </div>

    </div>

  </div>
</div>
{!! Form::close() !!}

{!! Form::open(['url' => route('cashier.cancelchangecash'), 'data-parsley-validate']) !!}
@if (!empty($selectedsysteminfo))
<input id="selectedsystem" name="selectedsystem" type="hidden" class="form-control" value = {!! $selectedsysteminfo->id !!}>
@endif
<div class="modal fade" id="viewchangecashmodal" role="dialog">
  <div class="modal-dialog" id="viewchangecashdialog">

    <!-- Modal content-->

    <div class="modal-content" id="modal-content">
      <div class="modal-header" id="modal-header">
        {!! Form::button('&times;', array('type' => 'button', 'id' => 'viewchangecashclose', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
        Change Request
      </div>

      <div class="modal-body" id="modal-body">
        <div class="row">
          <div class="col-xs-6">
            <div class="row">
              <div class="col-xs-4">
              </div>
              <div class="col-xs-6">
                Original Shift
              </div>
              <div class="col-xs-2">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                In: <span id="vieworiginalInCash"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Out: <span id="vieworiginalOutCash"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Shift Start Date: <span id="vieworiginalstartdate"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Shift Start Time: <span id="vieworiginalstarttime"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Shift End Date: <span id="vieworiginalenddate"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Shift End Time: <span id="vieworiginalendtime"></span>
              </div>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="row">
              <div class="col-xs-4">
              </div>
              <div class="col-xs-6">
                Modified Shift
              </div>
              <div class="col-xs-2">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                In: <span id="viewmodifiedInCash"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Out: <span id="viewmodifiedOutCash"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Shift Start Date: <span id="viewmodifiedstartdate"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Shift Start Time: <span id="viewmodifiedstarttime"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Shift End Date: <span id="viewmodifiedenddate"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-1">
              </div>
              <div class="col-xs-11">
                Shift End Time: <span id="viewmodifiedendtime"></span>
              </div>
            </div>
          </div>
        </div>

        <br/>
        <input type="hidden" id="changecashierdataid" name="changecashierdataid">

        <div class="row">
          <div class="col-xs-1">
          </div>
          <div class="col-xs-5">
            {!! Form::button('OK', array('type' => 'button', 'name' => 'changebutton', 'class' => 'btn btn-default', 'data-dismiss' => 'modal', 'style' => 'width:100%; height:5%;')) !!}
          </div>
          <div class="col-xs-5">
            {!! Form::button('Cancel', array('type' => 'submit', 'name' => 'cancelchangebutton', 'class' => 'btn btn-default', 'style' => 'width:100%; height:5%;')) !!}
          </div>
          <div class="col-xs-1">
          </div>
        </div>
      </div>

      <div class="modal-footer" id="modal-footer">
      </div>

    </div>

  </div>
</div>
{!! Form::close() !!}

<script>

$.widget( "ui.timespinner", $.ui.spinner, {
  options: {
    // seconds
    step: 60 * 1000,
    // hours
    page: 60
  },

  _parse: function( value ) {
    if ( typeof value === "string" ) {
      // already a timestamp
      if ( Number( value ) == value ) {
        return Number( value );
      }
      return +Globalize.parseDate( value );
    }
    return value;
  },

  _format: function( value ) {
    return Globalize.format( new Date(value), "t" );
  }
});

var startDate = new Date();

$("#startdate").datepicker({
  format: "mm/dd/yy",
  startDate: startDate
});

$("#changestartdate").datepicker({
  format: "mm/dd/yy",
  startDate: startDate
});

$("#starttime").timespinner({
  spin : function(e, ui) {
    var year = '20' + $('#startdate').val().substr(6,2);
    var month = $('#startdate').val().substr(0,2);
    var date = $('#startdate').val().substr(3,2);
    var time = new Date(ui.value);
    var startDate = new Date(year, month-1, date, time.getHours(), time.getMinutes());
    if (startDate.getHours() >= 16)
    {
      var endDate = new Date(startDate.getTime() + 8 * 60 * 60 * 1000);
      if ((endDate.getMonth()+1) > 9)
      {
        if (endDate.getDate() > 9) {
          $("#enddate").val((endDate.getMonth()+1)+'/'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
        } else {
          $("#enddate").val((endDate.getMonth()+1)+'/0'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
        }
      } else {
        if (endDate.getDate() > 9) {
          $("#enddate").val('0'+(endDate.getMonth()+1)+'/'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
        } else {
          $("#enddate").val('0'+(endDate.getMonth()+1)+'/0'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
        }
      }

      if (startDate.getHours() == 16) {
        if (endDate.getMinutes() > 9) {
          $("#endtime").val("12:" + endDate.getMinutes() + " AM");
        } else {
          $("#endtime").val("12:0" + endDate.getMinutes() + " AM");
        }
      } else {
        if (endDate.getMinutes() > 9) {
          $("#endtime").val(endDate.getHours() + ":" + endDate.getMinutes() + " AM");
        } else {
          $("#endtime").val(endDate.getHours() + ":0" + endDate.getMinutes() + " AM");
        }
      }
    } else {
      if ((startDate.getMonth()+1) > 9)
      {
        if (startDate.getDate() > 9) {
          $("#enddate").val((startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
        } else {
          $("#enddate").val((startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
        }
      } else {
        if (startDate.getDate() > 9) {
          $("#enddate").val('0'+(startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
        } else {
          $("#enddate").val('0'+(startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
        }
      }

      var ampm = (startDate.getHours() >= 4) ? "PM" : "AM";

      if (startDate.getHours() > 4)
      {
        if (startDate.getMinutes() > 9) {
          $("#endtime").val((startDate.getHours() - 4) + ":" + startDate.getMinutes() + " " + ampm);
        } else {
          $("#endtime").val((startDate.getHours() - 4) + ":0" + startDate.getMinutes() + " " + ampm);
        }
      } else {
        if (startDate.getMinutes() > 9) {
          $("#endtime").val((startDate.getHours() + 8) + ":" + startDate.getMinutes() + " " + ampm);
        } else {
          $("#endtime").val((startDate.getHours() + 8) + ":0" + startDate.getMinutes() + " " + ampm);
        }
      }
    }
  }
});

$("#changestarttime").timespinner();

$('#enddate').datepicker({
  format: 'mm/dd/yy',
  startDate: startDate
});

$('#changeenddate').datepicker({
  format: 'mm/dd/yy',
  startDate: startDate
});

$("#endtime").timespinner();
$("#changeendtime").timespinner();

$("#InCash").spinner({
  culture:"en-US",
  min: 0,
  step: 1,
  numberFormat: "C"
});

$("#changeInCash").spinner({
  culture:"en-US",
  min: 0,
  step: 1,
  numberFormat: "C"
});

$("#OutCash").spinner({
  culture:"en-US",
  min: 0,
  step: 1,
  numberFormat: "C",
  // spin: function(e, ui) {
  //   $incash = parseInt($('#InCash').val().substr(1));
  //   if(ui.value == $incash) {
  //     console.log(ui.value);
  //     console.log($incash);
  //     $(this).siblings('.ui-spinner-up').removeClass('ui-spinner-up');
  //     $('#OutCash').val("$"+ui.value+".00");
  //   }
  // }
});

$("#changeOutCash").spinner({
  culture:"en-US",
  min: 0,
  step: 1,
  numberFormat: "C"
});

$("#addcashlink").click(function() {

  var startDate = new Date();
  if((startDate.getMonth()+1) > 9)
  {
    if(startDate.getDate() > 9) {
      $("#startdate").val((startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
    } else {
      $("#startdate").val((startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
    }
  } else {
    if(startDate.getDate() > 9) {
      $("#startdate").val('0'+(startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
    } else {
      $("#startdate").val('0'+(startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
    }
  }

  var ampm = (startDate.getHours() >= 12) ? "PM" : "AM";

  if (startDate.getHours() > 12)
  {
    if (startDate.getMinutes() > 9) {
      $("#starttime").val((startDate.getHours() - 12) + ":" + startDate.getMinutes() + " " + ampm);
    } else {
      $("#starttime").val((startDate.getHours() - 12) + ":0" + startDate.getMinutes() + " " + ampm);
    }
  } else {
    if (startDate.getHours() == 0) {
      if (startDate.getMinutes() > 9) {
        $("#starttime").val("12:" + startDate.getMinutes() + " " + ampm);
      } else {
        $("#starttime").val("12:0" + startDate.getMinutes() + " " + ampm);
      }
    } else {
      if (startDate.getMinutes() > 9) {
        $("#starttime").val(startDate.getHours() + ":" + startDate.getMinutes() + " " + ampm);
      } else {
        $("#starttime").val(startDate.getHours() + ":0" + startDate.getMinutes() + " " + ampm);
      }
    }
  }

  if (startDate.getHours() >= 16)
  {
    var endDate = new Date(startDate.getTime() + 8 * 60 * 60 * 1000);
    if((endDate.getMonth()+1) > 9)
    {
      if(endDate.getDate() > 9) {
        $("#enddate").val((endDate.getMonth()+1)+'/'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val((endDate.getMonth()+1)+'/0'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      }
    } else {
      if(endDate.getDate() > 9) {
        $("#enddate").val('0'+(endDate.getMonth()+1)+'/'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val('0'+(endDate.getMonth()+1)+'/0'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      }
    }

    if (startDate.getHours() == 16) {
      if (endDate.getMinutes() > 9) {
        $("#endtime").val("12:" + endDate.getMinutes() + " AM");
      } else {
        $("#endtime").val("12:0" + endDate.getMinutes() + " AM");
      }
    } else {
      if (endDate.getMinutes() > 9) {
        $("#endtime").val(endDate.getHours() + ":" + endDate.getMinutes() + " AM");
      } else {
        $("#endtime").val(endDate.getHours() + ":0" + endDate.getMinutes() + " AM");
      }
    }
  } else {
    if((startDate.getMonth()+1) > 9)
    {
      if(startDate.getDate() > 9) {
        $("#enddate").val((startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val((startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      }
    } else {
      if(startDate.getDate() > 9) {
        $("#enddate").val('0'+(startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val('0'+(startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      }
    }

    var ampm = (startDate.getHours() >= 4) ? "PM" : "AM";

    if (startDate.getHours() > 4)
    {
      if (startDate.getMinutes() > 9) {
        $("#endtime").val((startDate.getHours() - 4) + ":" + startDate.getMinutes() + " " + ampm);
      } else {
        $("#endtime").val((startDate.getHours() - 4) + ":0" + startDate.getMinutes() + " " + ampm);
      }
    } else {
      if (startDate.getMinutes() > 9) {
        $("#endtime").val((startDate.getHours() + 8) + ":" + startDate.getMinutes() + " " + ampm);
      } else {
        $("#endtime").val((startDate.getHours() + 8) + ":0" + startDate.getMinutes() + " " + ampm);
      }
    }
  }
});

$('#startdate').change(function() {
  var year = '20' + $('#startdate').val().substr(6,2);
  var month = $('#startdate').val().substr(0,2);
  var date = $('#startdate').val().substr(3,2);
  var timelength = $('#starttime').val().length;
  if (timelength == 7) {
    var ampm = $('#starttime').val().substr(5,2);
    if (ampm == 'AM')
    {
      var hours = $('#starttime').val().substr(0,1);
      var minutes = $('#starttime').val().substr(2,2);
    } else {
      var hours = parseInt($('#starttime').val().substr(0,1)) + 12;
      var minutes = $('#starttime').val().substr(2,2);
    }
  } else if (timelength == 8) {
    var ampm = $('#starttime').val().substr(6,2);
    if (ampm == 'AM')
    {
      if ($('#starttime').val().substr(0,2) == 12) {
        var hours = 0;
        var minutes = $('#starttime').val().substr(3,2);
      } else {
        var hours = $('#starttime').val().substr(0,2);
        var minutes = $('#starttime').val().substr(3,2);
      }
    } else {
      if ($('#starttime').val().substr(0,2) == 12) {
        var hours = 12;
        var minutes = $('#starttime').val().substr(3,2);
      } else {
        var hours = parseInt($('#starttime').val().substr(0,2)) + 12;
        var minutes = $('#starttime').val().substr(3,2);
      }
    }
  }
  var startDate = new Date(year, month-1, date, hours, minutes);
  if (startDate.getHours() >= 16)
  {
    var endDate = new Date(startDate.getTime() + 8 * 60 * 60 * 1000);
    if ((endDate.getMonth()+1) > 9)
    {
      if (endDate.getDate() > 9) {
        $("#enddate").val((endDate.getMonth()+1)+'/'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val((endDate.getMonth()+1)+'/0'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      }
    } else {
      if (endDate.getDate() > 9) {
        $("#enddate").val('0'+(endDate.getMonth()+1)+'/'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val('0'+(endDate.getMonth()+1)+'/0'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      }
    }

    if (startDate.getHours() == 16) {
      if (endDate.getMinutes() > 9) {
        $("#endtime").val("12:" + endDate.getMinutes() + " AM");
      } else {
        $("#endtime").val("12:0" + endDate.getMinutes() + " AM");
      }
    } else {
      if (endDate.getMinutes() > 9) {
        $("#endtime").val(endDate.getHours() + ":" + endDate.getMinutes() + " AM");
      } else {
        $("#endtime").val(endDate.getHours() + ":0" + endDate.getMinutes() + " AM");
      }
    }
  } else {
    if ((startDate.getMonth()+1) > 9)
    {
      if (startDate.getDate() > 9) {
        $("#enddate").val((startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val((startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      }
    } else {
      if (startDate.getDate() > 9) {
        $("#enddate").val('0'+(startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val('0'+(startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      }
    }

    var ampm = (startDate.getHours() >= 4) ? "PM" : "AM";

    if (startDate.getHours() > 4)
    {
      if (startDate.getMinutes() > 9) {
        $("#endtime").val((startDate.getHours() - 4) + ":" + startDate.getMinutes() + " " + ampm);
      } else {
        $("#endtime").val((startDate.getHours() - 4) + ":0" + startDate.getMinutes() + " " + ampm);
      }
    } else {
      if (startDate.getMinutes() > 9) {
        $("#endtime").val((startDate.getHours() + 8) + ":" + startDate.getMinutes() + " " + ampm);
      } else {
        $("#endtime").val((startDate.getHours() + 8) + ":0" + startDate.getMinutes() + " " + ampm);
      }
    }
  }
});

$('#starttime').change(function() {
  var year = '20' + $('#startdate').val().substr(6,2);
  var month = $('#startdate').val().substr(0,2);
  var date = $('#startdate').val().substr(3,2);
  var timelength = $('#starttime').val().length;
  if (timelength == 7) {
    var ampm = $('#starttime').val().substr(5,2);
    if (ampm == 'AM')
    {
      var hours = $('#starttime').val().substr(0,1);
      var minutes = $('#starttime').val().substr(2,2);
    } else {
      var hours = parseInt($('#starttime').val().substr(0,1)) + 12;
      var minutes = $('#starttime').val().substr(2,2);
    }
  } else if (timelength == 8) {
    var ampm = $('#starttime').val().substr(6,2);
    if (ampm == 'AM')
    {
      if ($('#starttime').val().substr(0,2) == 12) {
        var hours = 0;
        var minutes = $('#starttime').val().substr(3,2);
      } else {
        var hours = $('#starttime').val().substr(0,2);
        var minutes = $('#starttime').val().substr(3,2);
      }
    } else {
      if ($('#starttime').val().substr(0,2) == 12) {
        var hours = 12;
        var minutes = $('#starttime').val().substr(3,2);
      } else {
        var hours = parseInt($('#starttime').val().substr(0,2)) + 12;
        var minutes = $('#starttime').val().substr(3,2);
      }
    }
  }
  var startDate = new Date(year, month-1, date, hours, minutes);
  if (startDate.getHours() >= 16)
  {
    var endDate = new Date(startDate.getTime() + 8 * 60 * 60 * 1000);
    if ((endDate.getMonth()+1) > 9)
    {
      if (endDate.getDate() > 9) {
        $("#enddate").val((endDate.getMonth()+1)+'/'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val((endDate.getMonth()+1)+'/0'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      }
    } else {
      if (endDate.getDate() > 9) {
        $("#enddate").val('0'+(endDate.getMonth()+1)+'/'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val('0'+(endDate.getMonth()+1)+'/0'+endDate.getDate()+'/'+endDate.getFullYear().toString().substr(2,2));
      }
    }

    if (startDate.getHours() == 16) {
      if (endDate.getMinutes() > 9) {
        $("#endtime").val("12:" + endDate.getMinutes() + " AM");
      } else {
        $("#endtime").val("12:0" + endDate.getMinutes() + " AM");
      }
    } else {
      if (endDate.getMinutes() > 9) {
        $("#endtime").val(endDate.getHours() + ":" + endDate.getMinutes() + " AM");
      } else {
        $("#endtime").val(endDate.getHours() + ":0" + endDate.getMinutes() + " AM");
      }
    }
  } else {
    if ((startDate.getMonth()+1) > 9)
    {
      if (startDate.getDate() > 9) {
        $("#enddate").val((startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val((startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      }
    } else {
      if (startDate.getDate() > 9) {
        $("#enddate").val('0'+(startDate.getMonth()+1)+'/'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      } else {
        $("#enddate").val('0'+(startDate.getMonth()+1)+'/0'+startDate.getDate()+'/'+startDate.getFullYear().toString().substr(2,2));
      }
    }

    var ampm = (startDate.getHours() >= 4) ? "PM" : "AM";

    if (startDate.getHours() > 4)
    {
      if (startDate.getMinutes() > 9) {
        $("#endtime").val((startDate.getHours() - 4) + ":" + startDate.getMinutes() + " " + ampm);
      } else {
        $("#endtime").val((startDate.getHours() - 4) + ":0" + startDate.getMinutes() + " " + ampm);
      }
    } else {
      if (startDate.getMinutes() > 9) {
        $("#endtime").val((startDate.getHours() + 8) + ":" + startDate.getMinutes() + " " + ampm);
      } else {
        $("#endtime").val((startDate.getHours() + 8) + ":0" + startDate.getMinutes() + " " + ampm);
      }
    }
  }
});

var system_id = $('#systemlist').val();

$.get('/getroomlist/' + system_id, function (data) {
  var count = 0;
  var roomid;
  $.each(data, function(i, value) {
    $('#roomlist').html($('#roomlist').html() +
      '<option value=' + value.id + '>' +
      value.name +
      '</option>');
    roomid = value.id;
    count++;
  });
  if (count == 0) {
    $('#roomlist').attr('disabled', 'true');
    $('#addbutton').attr('disabled');
    $('#roomlist').html('<option><b>No rooms are available!</b></option>');
  } else if (count == 1) {
    $('#roomlist').attr('disabled', 'true');
    $('#roomlistdiv').html($('#roomlistdiv').html() +
      '<input type="hidden" name="roomlist" value=' + roomid + ' />');
  }
});

$('#systemlist').change(function() {
  $('#roomlist').removeAttr('disabled');
  $('#addbutton').removeAttr('disabled');
  $('#roomlist').html('');
  var system_id = $('#systemlist').val();

  $.get('/getroomlist/' + system_id, function (data) {
    var count = 0;
    var roomid;
    $.each(data, function(i, value) {
      $('#roomlist').html($('#roomlist').html() +
        '<option value=' + value.id + '>' +
        value.name +
        '</option>');
      roomid = value.id;
      count++;
    });
    if (count == 0) {
      $('#roomlist').attr('disabled', 'true');
      $('#addbutton').attr('disabled', 'true');
      $('#roomlist').html('<option><b>No rooms are available!</b></option>');
    } else if (count == 1) {
      $('#roomlist').attr('disabled', 'true');
      $('#roomlistdiv').html($('#roomlistdiv').html() +
        '<input type="hidden" name="roomlist" value=' + roomid + ' />');
    }
  });
});

$('.datarow').hover(
  function() {
    $(this).addClass('hover');
  },

  function() {
    $(this).removeClass('hover');
  }
);

$('.deleterequest').hover(
  function() {
    $(this).addClass('modifyrequest');
  },

  function() {
    $(this).removeClass('modifyrequest');
  }
);

$('.changerequest').hover(
  function() {
    $(this).addClass('modifyrequest');
  },

  function() {
    $(this).removeClass('modifyrequest');
  }
);


$('.datacell').click(function(){
  var cashierdataid = $(this).data('val');

  $.get('/cashierdata/' + cashierdataid, function (data) {
    $('#changestartdate').val(data.start_date.substr(0,6)+data.start_date.substr(8,2));
    $('#changestarttime').val(data.start_time);
    $('#changeenddate').val(data.end_date.substr(0,6)+data.end_date.substr(8,2));
    $('#changeendtime').val(data.end_time);
    $('#changeInCash').val(data.In);
    $('#changeOutCash').val(data.Out);
    $('#cashierdataid').val(data.id);
  });
});

$('.deleterequest').click(function(){
  var cashierdataid = $(this).data('val');

  $.get('/cashierdata/' + cashierdataid, function (data) {
    $('#viewdeleteInCash').html(data.In);
    $('#viewdeleteOutCash').html(data.Out);
    $('#viewdeletestartdate').html(data.start_date);
    $('#viewdeletestarttime').html(data.start_time);
    $('#viewdeleteenddate').html(data.end_date);
    $('#viewdeleteendtime').html(data.end_time);
    $('#deletecashierdataid').val(data.id);
  });
});

$('.changerequest').click(function(){
  var cashierdataid = $(this).data('val');

  $.get('/cashierdata/' + cashierdataid, function (data) {
    $('#vieworiginalInCash').html(data.In);
    $('#vieworiginalOutCash').html(data.Out);
    $('#vieworiginalstartdate').html(data.start_date);
    $('#vieworiginalstarttime').html(data.start_time);
    $('#vieworiginalenddate').html(data.end_date);
    $('#vieworiginalendtime').html(data.end_time);
    $('#changecashierdataid').val(data.id);
  });

  $.get('/newcashierdata/' + cashierdataid, function (data) {
    $('#viewmodifiedInCash').html(data.In);
    $('#viewmodifiedOutCash').html(data.Out);
    $('#viewmodifiedstartdate').html(data.start_date);
    $('#viewmodifiedstarttime').html(data.start_time);
    $('#viewmodifiedenddate').html(data.end_date);
    $('#viewmodifiedendtime').html(data.end_time);
  });
});

</script>
@endsection
