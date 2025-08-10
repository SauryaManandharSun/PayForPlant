<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    protected $fillable = ['name', 'location', 'price', 'stock', 'image'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
