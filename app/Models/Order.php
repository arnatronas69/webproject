<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name' ,
        'item_price',
        'item_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'company_name',
        'address_line_1',
        'address_line_2',
        'town_city',
        'state',
        // Add other order details fields here
    ];

    public function item()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }
}
