<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\System;
use App\Room;
use App\S_R_relation;
use App\U_R_relation;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function overview()
  {
      $systems = System::get();
      $rooms = Room::get();
      $users = User::get();
      $data = array(
        'systems' => $systems,
        'rooms' => $rooms,
        'users' => $users
      );
      return view('admin.overview', $data);
  }

  public function newsystem(Request $request)
  {
      $system = new System;
      $system->name = $request->systemname;

      $system->save();
      return redirect()->route('admin.overview');
  }

  public function systemtorooms(Request $request)
  {
      $rooms = Room::get();
      foreach($rooms as $room => $value)
      {
        if ($request->has($value->name))
        {
          if (!S_R_relation::where('system_id', $request->system)
                           ->where('room_id', $value->id)->exists()) {
            $s_r_relation = new S_R_relation;
            $s_r_relation->system_id = $request->system;
            $s_r_relation->room_id = $value->id;
            $s_r_relation->save();
          }
        } else {
          if (S_R_relation::where('system_id', $request->system)
                           ->where('room_id', $value->id)->exists()) {
            $delete_relation = S_R_relation::where('system_id', $request->system)
                                           ->where('room_id', $value->id)
                                           ->delete();
          }
        }
      }

      return redirect()->route('admin.overview');
  }

  public function newroom(Request $request)
  {
      $room = new Room;
      $room->name = $request->roomname;

      $room->save();
      return redirect()->route('admin.overview');
  }

  public function roomtosystems(Request $request)
  {
      $systems = System::get();
      foreach($systems as $system => $value)
      {
        if ($request->has($value->name))
        {
          if (!S_R_relation::where('room_id', $request->room)
                           ->where('system_id', $value->id)->exists()) {
            $s_r_relation = new S_R_relation;
            $s_r_relation->room_id = $request->room;
            $s_r_relation->system_id = $value->id;
            $s_r_relation->save();
          }
        } else {
          if (S_R_relation::where('room_id', $request->room)
                          ->where('system_id', $value->id)->exists()) {
            $delete_relation = S_R_relation::where('room_id', $request->room)
                                           ->where('system_id', $value->id)
                                           ->delete();
          }
        }
      }

      return redirect()->route('admin.overview');
  }

  public function newuser(Request $request)
  {
      User::create([
          'email' => $request->email,
          'name' => $request->name,
          'password' => bcrypt($request->password),
          'role' => $request->role,
      ]);
      return redirect()->route('admin.overview');
  }

  public function edituser(Request $request)
  {
      $userpass = User::where('id', $request->user)
                      ->first();
      $userpass->password = bcrypt($request->newpassword);

      $userpass->save();

      $rooms = Room::get();
      foreach($rooms as $room => $value)
      {
        if ($request->has($value->name))
        {
          if (!U_R_relation::where('user_id', $request->user)
                           ->where('room_id', $value->id)->exists()) {
            $u_r_relation = new U_R_relation;
            $u_r_relation->user_id = $request->user;
            $u_r_relation->room_id = $value->id;
            $u_r_relation->save();
          }
        } else {
          if (U_R_relation::where('user_id', $request->user)
                          ->where('room_id', $value->id)->exists()) {
            $delete_relation = U_R_relation::where('user_id', $request->user)
                                           ->where('room_id', $value->id)
                                           ->delete();
          }
        }
      }

      return redirect()->route('admin.overview');
  }
}
