<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price'];

    public function updateTotalPrice()
    {
        $totalPrice = $this->items()->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $this->total_price = $totalPrice;
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
