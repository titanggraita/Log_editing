<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_logediting extends Model
{
    protected $connection = 'sqlsrv';
    public $incrementing = true;
    protected $table = 'transaction_logediting'; 
}
