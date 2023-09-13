<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $guarded = [];
    public $timestamps = false;
    public function categories()
    {
        return $this->hasMany(Category::class,'brand_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'brand_id');
    }
}
