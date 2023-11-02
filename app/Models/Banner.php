<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
     protected $fillable = ['image','target','created_at', 'updated_at'];
     public $timestamps = true;
}
