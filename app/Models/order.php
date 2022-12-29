<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table='order';
    protected $primaryKey='order';

    protected $fillable=[      
        'order_id',
        'order_item_id',
        'order_status',
        'order_date',
        'order_merge',
        'order_quantity',
        'order_channel',
        'order_info',
        'order_tracking',
        'order_booking',
        'order_dimension',
        'order_action',
        'order_listing'
    ];

   

    // public function booking() {
    //     //return $this->hasOne(booking::class, 'booking', 'order');
    //     return $this->hasOne(booking::class, 'order');
    // }

   
    
    
}
