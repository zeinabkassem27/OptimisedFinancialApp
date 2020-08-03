<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'title' , 'flag', 'amount', 'start_date', 'end_date', 'interval', 'type', 'categories_id', 'users_id', 'currencies_id'
    ];
}
