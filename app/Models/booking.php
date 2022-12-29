<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table = 'booking_info';
    protected $primaryKey='booking';
    protected $fillable=[      
        'booking_type',
        'booking_date'
    ];  

    public function order() {
        return $this->hasOne(order::class, 'order', 'booki');
    }
}
