<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'badge', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
	public function parameters()
    {
    	return $this->hasMany('App\Parameter');
    }

    public function images()
    {
    	return $this->hasMany('App\Image');
    }
    
    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function price()
    {
        return number_format($this->price, 0, '', ' ');
    }
}
