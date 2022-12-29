<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table='user';
    protected $primaryKey='user';
    public $timestamps = true;
    protected $fillable=[      
        'user_firstname',
        'user_lastname',
        'user_email',
        'user_contact',
        'user_name',
        'user_password',
        'user_branch',
        'user_role',
        'user_upload_date'
    ];
}
