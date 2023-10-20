<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $name
 * @property string $image
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Product[] $products
 */
class L3Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'image', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'L3_category');
    }
}
