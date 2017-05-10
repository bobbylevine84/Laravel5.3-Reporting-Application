<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <title>{!! config('app.name', 'Reporting tool') !!}</title>

    <!-- Styles -->
    {!! Html::style('css/app.css') !!}
    @if (Auth::check())
    {!! Html::style('css/navigation.css') !!}
    {!! Html::style('css/bootstrap-datepicker.css') !!}
    @endif
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') !!}
    {!! Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') !!}
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @if (Auth::check())
    {!! Html::script('js/charts-loader.js') !!}
    {!! Html::script('js/bootstrap-datepicker.js') !!}
    {!! Html::script('js/jquery.mousewheel.js') !!}
    {!! Html::script('js/globalize.js') !!}
    {!! Html::script('js/globalize.culture.de-DE.js') !!}
    @endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                @if (Auth::guest())
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{!! url('/') !!}">
                        {!! config('app.name', 'Reporting tool') !!}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li>{!! HTML::link('/login', 'Login') !!}</li>
                        <li>{!! HTML::link('/register', 'Register') !!}</li>
                    </ul>
                </div>
                @endif
                @if (Auth::check())
                <div class="row">
                  <div class="col-md-4 col-xs-2">
                    <ul class="nav navbar-nav navbar-left" style="float:left">
                        <li class="dropdown">
                            <nav id="navigation">
                                <ul>
                                    <li>
                                        <a href="#">
                                          <h3>
                                            <i class="fa fa-bars"></i>&nbsp;
                                            @if (Auth::user()->role == 'Cashier')
                                            {{ $systemname }}
                                            @endif
                                          </h3>
                                        </a>
                                        <ul>
                                            @if (Auth::user()->role == 'Admin')
                                            <li>{!! HTML::link('#', 'System') !!}
                                              <ul>
                                                <li>{{ HTML::link('#', '(All)') }}</li>
                                                @foreach($systems as $system => $value)
                                                <li>{{ HTML::link('#', $value->name) }}</li>
                                                @endforeach
                                              </ul>
                                            </li>
                                            <li>{!! HTML::link('#', 'Room') !!}
                                              <ul>
                                                <li>{{ HTML::link('#', '(All)') }}</li>
                                                @foreach($rooms as $room => $value)
                                                <li>{{ HTML::link('#', $value->name) }}</li>
                                                @endforeach
                                              </ul>
                                            </li>
                                            @endif
                                            @if (Auth::user()->role == 'Cashier')
                                            <li>{{ HTML::link(route('cashier.home'), '(All)') }}</li>
                                            @foreach($systems as $system => $value)
                                            <li>
                                              {{ HTML::link(route('cashier.home', array('systemid' => $value->id)), $value->name) }}
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </li>
                    </ul>
                  </div>
                  <div class="col-md-4 col-xs-8">
                    <div class="row">
                      <div class="col-xs-2">
                      </div>
                      <div class="col-xs-8">
                        <ul class="nav navbar-nav" style="float:left;">
                          <li class="dropdown">
                            <nav id="settings">
                              <ul>
                                <li>
                                  <a href="#">
                                    @if (Auth::user()->role == 'Admin')
                                    <h3>ReportView <span class="glyphicon glyphicon-print"></span></h3>
                                    @else
                                    <h3>CashierView <span class="glyphicon glyphicon-print"></span></h3>
                                    @endif
                                  </a>
                                </li>
                              </ul>
                            </nav>
                          </li>
                        </ul>
                      </div>
                      <div class="col-xs-2">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-2">
                    <ul class="nav navbar-nav navbar-right" style="float:right">
                        <li class="dropdown">
                            <nav id="settings">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <h3><i class="fa fa-gear fa-lg"></i>
                                                @if (Auth::user()->role == 'Admin')
                                                <span style="position:absolute; margin-left:9px; margin-top:-29px; color:red;"><h5>1</h5></span>
                                                @endif
                                            </h3>
                                        </a>
                                        <ul>
                                          @if (Auth::user()->role == 'Admin')
                                          <li>{!! HTML::link('#', 'Systems') !!}
                                            <ul>
                                              <li><a href="#" data-toggle="modal" data-target="#addsystem">Add</a></li>
                                              <li><a href="#" data-toggle="modal" data-target="#systemtorooms">Configure</a></li>
                                            </ul>
                                          </li>
                                          <li>{!! HTML::link('#', 'Rooms') !!}
                                            <ul>
                                              <li><a href="#" data-toggle="modal" data-target="#addroom">Add</a></li>
                                              <li><a href="#" data-toggle="modal" data-target="#roomtosystems">Configure</a></li>
                                            </ul>
                                          </li>
                                          <li>{!! HTML::link('#', 'Users') !!}
                                            <ul>
                                              <li><a href="#" data-toggle="modal" data-target="#adduser">Add</a></li>
                                              <li><a href="#" data-toggle="modal" data-target="#edituser">Configure</a></li>
                                              <li><a href="#">Approvals</a></li>
                                            </ul>
                                          </li>
                                          <li>{!! HTML::link('#', 'Subscription Settings') !!}
                                            <ul>
                                              <li><a href="#">Payment Method</a></li>
                                              <li><a href="#">Autopay Frequency</a></li>
                                            </ul>
                                          </li>
                                          @endif
                                          @if (Auth::user()->role == 'Cashier')
                                          <li><a href="#" data-toggle="modal" data-target="#editcashier">{!! Auth::user()->name !!}</a></li>
                                          @endif
                                          <li>
                                            {!! HTML::link('/logout', 'Log Out', array('onclick' => 'event.preventDefault();
                                                     document.getElementById("logout-form").submit();')) !!}
                                            {!! Form::open(['url' => '/logout', 'id' => 'logout-form', 'style' => 'display: none;']) !!}
                                            {!! Form::close() !!}
                                          </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </li>
                    </ul>
                  </div>
                @endif
            </div>
        </nav>

        @yield('content')
    </div>

    @if (Auth::check())
    @if (Auth::user()->role == 'Admin')
    <div class="modal fade" id="addsystem" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          {!! Form::open(['url' => route('admin.newsystem'), 'data-parsley-validate']) !!}
          <div class="modal-header">
            {!! Form::button('&times;', array('type' => 'button', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
            <h4 class="modal-title">Create new system</h4>
          </div>

          <div class="modal-body">
            Name:
            {!! Form::text('systemname', '', array('class' => 'form-control', 'required' => 'true')) !!}
          </div>

          <div class="modal-footer">
            {!! Form::button('Create', array('type' => 'submit', 'class' => 'btn btn-default')) !!}
            {!! Form::button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) !!}
          </div>
          {!! Form::close() !!}

        </div>

      </div>
    </div>

    <div class="modal fade" id="systemtorooms" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          {!! Form::open(['url' => route('admin.systemtorooms'), 'data-parsley-validate']) !!}
          <div class="modal-header">
            {!! Form::button('&times;', array('type' => 'button', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
            <h4 class="modal-title">Assign the rooms to system</h4>
          </div>
          <div class="modal-body">
            <p>Select the System:
              <select class="form-control" name="system" id="system">
                @foreach($systems as $system => $value)
                <option value={!! $value->id !!}>{!! $value->name !!}</option>
                @endforeach
              </select>
            </p>
            <p>Assign the rooms:</p>
            <p>
              @foreach($rooms as $room => $value)
              <span>
                {{ Form::checkbox($value->name, $value->id, null, ['id' => 'room'.$value->id]) }}
                {{ Form::label('room'.$value->id, $value->name) }}
              </span>
              @endforeach
            </p>
          </div>
          <div class="modal-footer">
            {!! Form::button('Assign', array('type' => 'submit', 'class' => 'btn btn-default')) !!}
            {!! Form::button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) !!}
          </div>
          {!! Form::close() !!}

        </div>

      </div>
    </div>

    <div class="modal fade" id="addroom" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          {!! Form::open(['url' => route('admin.newroom'), 'data-parsley-validate']) !!}
          <div class="modal-header">
            {!! Form::button('&times;', array('type' => 'button', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
            <h4 class="modal-title">Create new room</h4>
          </div>
          <div class="modal-body">
            <p>Name:
              {!! Form::text('roomname', '', array('class' => 'form-control', 'required' => 'true')) !!}
            </p>
          </div>
          <div class="modal-footer">
            {!! Form::button('Create', array('type' => 'submit', 'class' => 'btn btn-default')) !!}
            {!! Form::button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) !!}
          </div>
          {!! Form::close() !!}

        </div>

      </div>
    </div>

    <div class="modal fade" id="roomtosystems" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          {!! Form::open(['url' => route('admin.roomtosystems'), 'data-parsley-validate']) !!}
          <div class="modal-header">
            {!! Form::button('&times;', array('type' => 'button', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
            <h4 class="modal-title">Assign the room to systems</h4>
          </div>
          <div class="modal-body">
            <p>Select the Room:
              <select class="form-control" name="room" id="room">
                @foreach($rooms as $room => $value)
                <option value={!! $value->id !!}>{!! $value->name !!}</option>
                @endforeach
              </select>
            </p>
            <p>Check the systems:</p>
            <p>
              @foreach($systems as $system => $value)
              <span>
                {{ Form::checkbox($value->name, $value->id, null, ['id' => 'system'.$value->id]) }}
                {{ Form::label('system'.$value->id, $value->name) }}
              </span>
              @endforeach
            </p>
          </div>
          <div class="modal-footer">
            {!! Form::button('Assign', array('type' => 'submit', 'class' => 'btn btn-default')) !!}
            {!! Form::button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) !!}
          </div>
          {!! Form::close() !!}

        </div>

      </div>
    </div>

    <div class="modal fade" id="adduser" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          {!! Form::open(['url' => route('admin.newuser'), 'id' => 'newuser', 'class' => 'form-horizontal', 'data-parsley-validate']) !!}
          <div class="modal-header">
            {!! Form::button('&times;', array('type' => 'button', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
            <h4 class="modal-title">Create new user</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="name" class="col-md-4 control-label">Name</label>

                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                  <div class="col-md-6">
                      <input id="email" type="email" class="form-control" name="email" required>
                  </div>
              </div>

              <div class="form-group" id="passworddiv">
                  <label for="password" class="col-md-4 control-label">Password</label>

                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" required>
                      <span class="help-block">
                          <strong id="passwordalert"></strong>
                      </span>
                  </div>
              </div>

              <div class="form-group">
                  <label for="password_confirm" class="col-md-4 control-label">Confirm Password</label>

                  <div class="col-md-6">
                      <input id="password_confirm" type="password" class="form-control" name="password_confirmation" required>
                  </div>
              </div>

              <div class="form-group">
                  <label for="role" class="col-md-4 control-label">Role</label>

                  <div class="col-md-6">
                      <select class="form-control" name="role" id="role">
                          <option value="Admin" >Admin</option>
                          <option value="Cashier" >Cashier</option>
                      </select>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            {!! Form::button('Create', array('type' => 'submit', 'class' => 'btn btn-default')) !!}
            {!! Form::button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) !!}
          </div>
          {!! Form::close() !!}

        </div>

      </div>
    </div>

    <div class="modal fade" id="edituser" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          {!! Form::open(['url' => route('admin.edituser'), 'id' => 'edituser', 'class' => 'form-horizontal', 'data-parsley-validate']) !!}
          <div class="modal-header">
            {!! Form::button('&times;', array('type' => 'button', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
            <h4 class="modal-title">Edit User</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  {{ Form::label('user', 'Select the User:', array('class' => 'col-md-4 control-label')) }}

                  <div class="col-md-6">
                      <select class="form-control" name="user" id="user">
                        @foreach($users as $user => $value)
                        <option value={!! $value->id !!}>{!! $value->name !!}({!! $value->role !!})</option>
                        @endforeach
                      </select>
                      @foreach($users as $user => $value)
                      {{ Form::hidden('userrole'.$value->id, $value->role, array('id' => 'userrole'.$value->id)) }}
                      @endforeach
                  </div>
              </div>

              <div class="form-group" id="newpassworddiv">
                  {{ Form::label('newpassword', 'New Password', array('class' => 'col-md-4 control-label')) }}

                  <div class="col-md-6">
                      {{ Form::password('newpassword', array('class' => 'form-control', 'id' => 'newpassword', 'required' => 'true')) }}
                      <span class="help-block">
                          <strong id="newpasswordalert"></strong>
                      </span>
                  </div>
              </div>

              <div class="form-group">
                  {{ Form::label('newpassword_confirm', 'Confirm Password', array('class' => 'col-md-4 control-label')) }}

                  <div class="col-md-6">
                      {{ Form::password('newpassword_confirm', array('class' => 'form-control', 'id' => 'newpassword_confirm', 'required' => 'true')) }}
                  </div>
              </div>

              <div class="form-group hidden" id="roompermission">
                  <div class="col-md-1">
                  </div>
                  {{ Form::label('role', 'Assign the rooms to cashier:', array('class' => 'col-md-5 control-label')) }}
                  <br/>
                  <br/>

                  <div class="col-md-2">
                  </div>

                  <div class="col-md-8">
                      @foreach($rooms as $room => $value)
                      <span>
                        {{ Form::checkbox($value->name, $value->id, null, ['id' => 'userroom'.$value->id]) }}
                        {{ Form::label('userroom'.$value->id, $value->name) }}
                      </span>
                      @endforeach
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            {!! Form::button('Assign', array('type' => 'submit', 'class' => 'btn btn-default')) !!}
            {!! Form::button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) !!}
          </div>
          {!! Form::close() !!}

        </div>

      </div>
    </div>

    <!-- Scripts -->
    <script>
    $(document).ready(function(){

      var system_id = $('#system').val();

      $.get('/system/' + system_id, function (data) {
        $.each(data, function(i, value) {
          $('#room'+value.room_id).attr('checked', true);
        });
      });

      $('#system').change(function(){
        var system_id = $('#system').val();
        @foreach($rooms as $room => $value)
          $('#room'+{{ $value->id }}).attr('checked', false);
        @endforeach
        $.get('/system/' + system_id, function (data) {
          $.each(data, function(i, value) {
            $('#room'+value.room_id).attr('checked', true);
          });
        });
      });

      var room_id = $('#room').val();

      $.get('/room/' + room_id, function (data) {
        $.each(data, function(i, value) {
          $('#system'+value.system_id).attr('checked', true);
        });
      });

      $('#room').change(function() {
        var room_id = $('#room').val();
        @foreach($systems as $system => $value)
          $('#system'+{{ $value->id }}).attr('checked', false);
        @endforeach
        $.get('/room/' + room_id, function (data) {
          $.each(data, function(i, value) {
            $('#system'+value.system_id).attr('checked', true);
          });
        });
      });

      $('#newuser').submit(function() {
        if( $('#password').val() != $('#password_confirm').val() )
        {
          $('#passworddiv').addClass('has-error');
          $('#passwordalert').html("The password confirmation does not match.");
          return false;
        }
      });

      var userId = $('#user').val();
      if ($('#userrole'+userId).val() == "Cashier")
      {
        $('#roompermission').removeClass('hidden');

        $.get('/user/' + userId, function (data) {
          $.each(data, function(i, value) {
            $('#userroom'+value.room_id).attr('checked', true);
          });
        });
      } else {
        $('#roompermission').addClass('hidden');
      }

      $('#user').change(function() {
        var userId = $('#user').val();
        if ($('#userrole'+userId).val() == "Cashier")
        {
          $('#roompermission').removeClass('hidden');

          @foreach($rooms as $room => $value)
            $('#userroom'+{{ $value->id }}).attr('checked', false);
          @endforeach

          $.get('/user/' + userId, function (data) {
            $.each(data, function(i, value) {
              $('#userroom'+value.room_id).attr('checked', true);
            });
          });
        } else {
          $('#roompermission').addClass('hidden');
        }
      });

      $('#edituser').submit(function() {
        if($('#newpassword').val() != $('#newpassword_confirm').val())
        {
          $('#newpassworddiv').addClass('has-error');
          $('#newpasswordalert').html("The password confirmation does not match.");
          return false;
        }
      });
    });
    </script>

    @endif

    @if (Auth::user()->role == 'Cashier')
    <div class="modal fade" id="editcashier" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          {!! Form::open(['url' => route('cashier.editcashier'), 'id' => 'editcashier', 'class' => 'form-horizontal', 'data-parsley-validate']) !!}
          <div class="modal-header">
            {!! Form::button('&times;', array('type' => 'button', 'class' => 'close', 'data-dismiss' => 'modal')) !!}
            <h4 class="modal-title">Edit Cashier</h4>
          </div>
          <div class="modal-body">

              <div class="form-group" id="newpassworddiv">
                  {{ Form::label('newpassword', 'New Password', array('class' => 'col-md-4 control-label')) }}

                  <div class="col-md-6">
                      {{ Form::password('newpassword', array('class' => 'form-control', 'id' => 'newpassword', 'required' => 'true')) }}
                      <span class="help-block">
                          <strong id="newpasswordalert"></strong>
                      </span>
                  </div>
              </div>

              <div class="form-group">
                  {{ Form::label('newpassword_confirm', 'Confirm Password', array('class' => 'col-md-4 control-label')) }}

                  <div class="col-md-6">
                      {{ Form::password('newpassword_confirm', array('class' => 'form-control', 'id' => 'newpassword_confirm', 'required' => 'true')) }}
                  </div>
              </div>
              {!! Form::button('Assign', array('type' => 'submit', 'class' => 'btn btn-default')) !!}
              {!! Form::button('Close', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) !!}
          </div>
          <div class="modal-footer">
          </div>
          {!! Form::close() !!}

        </div>

      </div>
    </div>

    <!-- Scripts -->
    <script>
    $(document).ready(function(){
      $('#editcashier').submit(function() {
        if($('#newpassword').val() != $('#newpassword_confirm').val())
        {
          $('#newpassworddiv').addClass('has-error');
          $('#newpasswordalert').html("The password confirmation does not match.");
          return false;
        }
      });
    });
    </script>
    @endif
    @endif
    {!! Html::script('js/app.js') !!}

</body>
</html>
