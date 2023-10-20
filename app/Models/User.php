<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @property integer $id
 * @property int $address_id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property int $otp
 * @property string $password
 * @property string $google_id
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Address $address
 * @property Address[] $addresses
 * @property OauthAccessToken[] $oauthAccessTokens
 */
class User extends Authenticatable
{

    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $hidden = [
        'password',
        'remember_token',
        // 'two_factor_recovery_codes',
        // 'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array
     */
    //protected $fillable = ['address_id', 'name', 'username', 'email', 'phone', 'otp', 'password', 'google_id', 'status', 'created_at', 'updated_at'];
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'otp',
        'password',
        'google_id',
        'is_verified',
      

    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function oauthAccessTokens()
    // {
    //     return $this->hasMany('App\Models\OauthAccessToken');
    // }
}