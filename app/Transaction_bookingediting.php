<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_bookingediting extends Model
{
    protected $connection = 'sqlsrv';
    public $incrementing = true;
    protected $table = 'transaction_bookingediting'; 
    // protected $fillable = [
    //     'bookingediting_id'
    // ];
}
