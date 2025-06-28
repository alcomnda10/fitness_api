<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id',
        'price',
        'address',
        'city',
        'state',
        'postal_code',
        'card_name',
        'card_number',
        'expiry',
        'cvc'
    ];
}
