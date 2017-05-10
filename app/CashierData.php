<?php

namespace App;
use Gbrock\Table\Traits\Sortable;

use Illuminate\Database\Eloquent\Model;

class CashierData extends Model
{
    protected $table = 'cashierdata';
    public $timestamps = false;
    use Sortable;
    protected $sortable = ['start_date', 'start_time', 'end_date', 'end_time', 'In', 'Out', 'Hold', 'change_request'];
}
