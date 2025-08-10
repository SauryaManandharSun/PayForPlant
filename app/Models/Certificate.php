<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['order_id', 'certificate_path', 'issued_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
