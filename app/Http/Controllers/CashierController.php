<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\System;
use App\Room;
use App\CashierData;
use App\New_CashierData;
use App\U_R_relation;
use Auth;
use Table;

class CashierController extends Controller
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

  public function home(Request $request)
  {
      $systems = System::get();
      $rooms = Room::get();
      $roomlist = U_R_relation::select('room_id')
                              ->where('user_id', Auth::user()->id)
                              ->get();
      $roomarray = array();
      $i = 0;
      foreach( $roomlist as $room => $value)
      {
        $roomarray[$i] = $value->room_id;
        $i++;
      }

      if ($request->systemid) {
        $selectedsysteminfo = System::where('id', $request->systemid)
                                    ->first();
        $systemname = $selectedsysteminfo->name;

        $cashierdata = CashierData::where('system_id', $request->systemid)
                                  ->whereIn('room_id', $roomarray)
                                  ->sorted()->paginate();
        $selectedsystem = System::where('id', $request->systemid)
                                ->get();
      } else {
        $systemname = "All systems";
        $selectedsystem = System::get();
        $cashierdata = CashierData::whereIn('room_id', $roomarray)
                                  ->sorted()->paginate();
      }
      $table = Table::create($cashierdata, ['start_date', 'start_time', 'end_date', 'end_time', 'In', 'Out', 'Hold', 'change_request']);
      if ($request->systemid) {
        $data = array(
          'systems' => $systems,
          'rooms' => $rooms,
          'systemname' => $systemname,
          'selectedsysteminfo' => $selectedsysteminfo,
          'selectedsystem' => $selectedsystem,
          'table' => $table
        );
      } else {
        $data = array(
          'systems' => $systems,
          'rooms' => $rooms,
          'systemname' => $systemname,
          'selectedsystem' => $selectedsystem,
          'table' => $table
        );
      }
      return view('cashier/home', $data);
  }

  public function addcash(Request $request)
  {
      $startdate = substr_replace($request->startdate, '20', 6, 0);
      $enddate = substr_replace($request->enddate, '20', 6, 0);
      $holdvalue = number_format((substr($request->InCash, 1) - substr($request->OutCash, 1)), 2, '.', '');
      $hold = '$'.$holdvalue;

      $cashierdata = new CashierData;
      $cashierdata->system_id = $request->systemlist;
      $cashierdata->room_id = $request->roomlist;
      $cashierdata->start_date = $startdate;
      $cashierdata->start_time = $request->starttime;
      $cashierdata->end_date = $enddate;
      $cashierdata->end_time = $request->endtime;
      $cashierdata->In = $request->InCash;
      $cashierdata->Out = $request->OutCash;
      $cashierdata->Hold = $hold;
      $cashierdata->save();
      if ($request->selectedsystem)
        return redirect()->route('cashier.home', array('systemid' => $request->selectedsystem));
      else
        return redirect()->route('cashier.home');
  }

  public function changecash(Request $request)
  {
      $cashierdata = CashierData::where('id', $request->cashierdataid)
                                ->first();
      if ($request->status == 'delete')
        $cashierdata->change_request = 'Delete';
      else if ($request->status == 'modify')
      {
        $startdate = substr_replace($request->changestartdate, '20', 6, 0);
        $enddate = substr_replace($request->changeenddate, '20', 6, 0);
        //$holdvalue = number_format((substr($request->changeInCash, 1) - substr($request->changeOutCash, 1)), 2, '.', '');
        //$hold = '$'.$holdvalue;
        $cashierdata->change_request = 'Modify';
        $newcashierdata = new New_CashierData;

        $newcashierdata->cashierdata_id = $request->cashierdataid;
        $newcashierdata->start_date = $startdate;
        $newcashierdata->start_time = $request->changestarttime;
        $newcashierdata->end_date = $enddate;
        $newcashierdata->end_time = $request->changeendtime;
        $newcashierdata->In = $request->changeInCash;
        $newcashierdata->Out = $request->changeOutCash;

        $newcashierdata->save();
      }
      $cashierdata->save();
      if ($request->selectedsystem)
        return redirect()->route('cashier.home', array('systemid' => $request->selectedsystem));
      else
        return redirect()->route('cashier.home');
  }

  public function canceldeletecash(Request $request)
  {
      $cashierdata = CashierData::where('id', $request->deletecashierdataid)
                                ->first();
      $cashierdata->change_request = NULL;

      $cashierdata->save();
      if ($request->selectedsystem)
        return redirect()->route('cashier.home', array('systemid' => $request->selectedsystem));
      else
        return redirect()->route('cashier.home');
  }

  public function cancelchangecash(Request $request)
  {
      $cashierdata = CashierData::where('id', $request->changecashierdataid)
                                ->first();
      $cashierdata->change_request = NULL;

      $cashierdata->save();

      New_CashierData::where('cashierdata_id', $request->changecashierdataid)
                     ->delete();

      if ($request->selectedsystem)
        return redirect()->route('cashier.home', array('systemid' => $request->selectedsystem));
      else
        return redirect()->route('cashier.home');
  }
}
