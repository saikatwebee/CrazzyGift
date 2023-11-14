<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $location
 * @property string $description
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class Testimonial extends Model
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
    protected $fillable = ['name', 'image', 'location', 'description', 'status', 'created_at', 'updated_at'];
}
