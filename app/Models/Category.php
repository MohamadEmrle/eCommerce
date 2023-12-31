<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [];
    public $timestamps = true;
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
