<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $main_category
 * @property int $sub_category
 * @property string $title
 * @property string $content
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property SubCategory $subCategory
 * @property MainCategory $mainCategory
 * @property Menu[] $menuses
 */
class Page extends Model
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
    protected $fillable = ['main_category', 'sub_category', 'title', 'content', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category');
    }

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
    public function menuses()
    {
        return $this->hasMany('App\Models\Menu');
    }
}
