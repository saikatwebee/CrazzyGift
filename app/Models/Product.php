<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property integer $id
 * @property int $main_category
 * @property int $sub_category
 * @property string $title
 * @property string $code
 * @property int $L3_category
 * @property string $description
 * @property string $product_image
 * @property string $product_alt_image1
 * @property string $product_alt_image2
 * @property string $product_alt_image3
 * @property string $product_type
 * @property string $weight
 * @property string $height
 * @property string $length
 * @property string $breadth
 * @property int $price
 * @property string $gst
 * @property string $discount
 * @property int $sale
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property MainCategory $mainCategory
 * @property L3Category $l3Category
 * @property SubCategory $subCategory
 * @property Cart[] $carts
 */
class Product extends Model
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
    protected $fillable = ['main_category', 'sub_category', 'title', 'code', 'L3_category', 'description', 'product_image', 'product_alt_image1', 'product_alt_image2', 'product_alt_image3', 'product_type', 'weight', 'height', 'length', 'breadth', 'price', 'gst', 'discount', 'sale', 'status', 'created_at', 'updated_at'];

   

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mainCategory()
    {
        return $this->belongsTo('App\Models\MainCategory', 'main_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function l3Category()
    {
        return $this->belongsTo('App\Models\L3Category', 'L3_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    
}
