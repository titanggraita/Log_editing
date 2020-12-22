<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_bookingeditingdetail extends Model
{
    protected $connection = 'sqlsrv';
    public $incrementing = true;
    protected $table = 'transaction_bookingeditingdetail'; 
}
