<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'queue';

    protected $fillable = [
        'customer_name',
        'contact_number',
        'queue_number',
        'service_type',
        'kg',
        'addons',
        'receiving_time',
        'total_price',
        'qr_code',
        'status',
        'staff_id'
    ];

    protected $casts = [
        'addons' => 'array'
    ];
}