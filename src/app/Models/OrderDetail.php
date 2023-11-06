<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quentity',
        'price',
        'order_id',
        'product_id'
    ];


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
