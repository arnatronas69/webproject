<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_price',
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

    public function items()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('item_id', 'item_price')
            ->withTimestamps();
    }
}
