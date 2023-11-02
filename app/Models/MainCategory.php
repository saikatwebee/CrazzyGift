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
 * @property Page[] $pages
 * @property Product[] $products
 * @property SubCategory[] $subCategories
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
    public function pages()
    {
        return $this->hasMany('App\Models\Page', 'main_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'main_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory', 'main_category');
    }
}
