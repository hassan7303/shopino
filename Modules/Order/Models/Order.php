<?php

namespace Modules\Order\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Models\Payment;
use Modules\User\Models\User;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'total' => 'decimal:2',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
