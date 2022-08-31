<?php

namespace App\Models\Opportunity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'client_id',
        'product_id',
        'seller_id'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}
