<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Product[] $products
 */
class MainCategory extends Model
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
        return $this->hasMany('App\Models\Product', 'main_category');
    }
}
