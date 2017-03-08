<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = ['total', 'delivery_id', 'comment'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function delivery()
    {
        return $this->belongsTo('App\Delivery');
    }

    public function total()
    {
        return number_format($this->total, 0, '', ' ');
    }
}
