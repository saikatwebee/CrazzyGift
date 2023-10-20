<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $order_id
 * @property string $product_details
 * @property float $amount
 * @property string $payment_status
 * @property string $order_status
 * @property string $billing_address
 * @property string $shipping_address
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Order extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'order_id', 'product_details', 'amount', 'payment_status', 'order_status', 'billing_address', 'shipping_address', 'created_at', 'updated_at','transaction_id','awb'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
