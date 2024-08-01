<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'name',
        'stock',
        'price',
        'category',
        'sold',
        'count',
        'size',
        'status',
        'image',
        'payment',
        'bukti_pembayaran'

    ];

    protected $casts = [
        'user_id' => 'integer',
        'stock' => 'integer',
        'price' => 'integer',
        'sold' => 'integer',
        'count' => 'integer',
        'payment' => 'integer',
        'id' => 'integer', 
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
