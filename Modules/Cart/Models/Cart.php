<?php

namespace Modules\Cart\Models;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
