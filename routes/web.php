<?php

use Illuminate\Support\Facades\Auth;
use App\S_R_relation;
use App\U_R_relation;
use App\CashierData;
use App\New_CashierData;
use App\Room;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  if (Auth::check())
  {
    if (Auth::user()->role == 'Admin')
      return redirect()->route('admin.overview');
    else if (Auth::user()->role == 'Cashier')
      return redirect()->route('cashier.home');
  } else
    return view('auth/login');
});

Route::get('/admin', 'AdminController@overview')->name('admin.overview');
Route::post('/newsystem', 'AdminController@newsystem')->name('admin.newsystem');
Route::post('/systemtorooms', 'AdminController@systemtorooms')->name('admin.systemtorooms');
Route::get('/system/{system_id?}', function($system_id){
    $rooms = S_R_relation::select('room_id')
                         ->where('system_id', $system_id)
                         ->get();

    return Response::json($rooms);
});
Route::get('/getroomlist/{system_id?}', function($system_id){
    $userid = Auth::user()->id;
    $rooms = DB::select(DB::raw("SELECT * FROM rooms
      WHERE (id IN (SELECT room_id FROM s_r_relation WHERE system_id = '$system_id'))
      AND (id IN (SELECT room_id FROM u_r_relation WHERE user_id = '$userid'));"));

    return Response::json($rooms);
});
Route::post('/newroom', 'AdminController@newroom')->name('admin.newroom');
Route::post('/roomtosystems', 'AdminController@roomtosystems')->name('admin.roomtosystems');
Route::get('/room/{room_id?}', function($room_id){
    $systems = S_R_relation::select('system_id')
                           ->where('room_id', $room_id)
                           ->get();

    return Response::json($systems);
});
Route::post('/newuser', 'AdminController@newuser')->name('admin.newuser');
Route::post('/edituser', 'AdminController@edituser')->name('admin.edituser');
Route::get('/user/{user_id?}', function($user_id){
    $rooms = U_R_relation::select('room_id')
                         ->where('user_id', $user_id)
                         ->get();

    return Response::json($rooms);
});
Route::get('/cashier', 'CashierController@home')->name('cashier.home');
Route::post('/addcash', 'CashierController@addcash')->name('cashier.addcash');
Route::post('/changecash', 'CashierController@changecash')->name('cashier.changecash');
Route::post('/canceldeletecash', 'CashierController@canceldeletecash')->name('cashier.canceldeletecash');
Route::post('/cancelchangecash', 'CashierController@cancelchangecash')->name('cashier.cancelchangecash');
Route::post('/editcashier', 'CashierController@editcashier')->name('cashier.editcashier');
Route::get('/cashierdata/{data_id?}', function($data_id){
    $cashierdata = CashierData::where('id', $data_id)
                              ->first();

    return Response::json($cashierdata);
});
Route::get('/newcashierdata/{data_id?}', function($data_id){
    $newcashierdata = New_CashierData::where('cashierdata_id', $data_id)
                                     ->first();

    return Response::json($newcashierdata);
});
Auth::routes();
