<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $main_category
 * @property string $name
 * @property string $image
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property MainCategory $mainCategory
 * @property Page[] $pages
 * @property Product[] $products
 */
class SubCategory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['main_category', 'name', 'image', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mainCategory()
    {
        return $this->belongsTo('App\Models\MainCategory', 'main_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany('App\Models\Page', 'sub_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'sub_category');
    }
}
