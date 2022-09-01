<?php

namespace App\Models\Opportunity;

use App\Models\Client\Client;
use App\Models\Product\Product;
use App\Models\Seller\Seller;
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

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getStatusNameAttribute()
    {
        switch ($this->status):
            case 1:
                $status = 'Pendente';
                break;
            case 2:
                $status = 'Aprovado';
                break;
            case 3:
                $status = 'Resucaso';
                break;
        endswitch;

        return $status ?? 'Pendente';
    }
}
