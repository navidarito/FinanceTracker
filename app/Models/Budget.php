<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'amount',
        'start_date',
        'end_date',
        'user_id',
        'category_id',
    ];
}
