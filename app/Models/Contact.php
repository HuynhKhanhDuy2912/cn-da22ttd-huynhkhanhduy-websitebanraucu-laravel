<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['fullname', 'phone_number', 'email', 'message', 'is_replied'];
}
