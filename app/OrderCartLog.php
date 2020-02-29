<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCartLog extends Model
{
    
    protected $fillable = ['order_id', 'text'];

}
