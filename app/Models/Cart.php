<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $user_id
 * @property integer $product_id
 * @property int $quantity
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Product $product
 */
class Cart extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'quantity','pincode','status','custom_text','custom_image','created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
