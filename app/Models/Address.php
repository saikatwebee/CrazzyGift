<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $user_id
 * @property string $street_address
 * @property string $address_type
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $alternate_phone
 * @property boolean $is_shipping_address
 * @property boolean $is_billing_address
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User[] $users
 */
class Address extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id','name','phone','street_address1','street_address2','street_address3','address_type', 'city', 'state', 'postal_code', 'alternate_phone', 'is_shipping_address', 'is_billing_address', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
