<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPrize extends Model
{
    use HasFactory;

    const TYPES = [
        'loyalty',
        'money',
        'item'
        ];

    const COEFFICIENT = 0.75;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'type',
        'user_id',
        'bank_card',
        'sent_status',
    ];



}
