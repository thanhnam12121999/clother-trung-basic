<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "categories";
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'parent'
    ];

    protected static function booted()
    {
        parent::booted();
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name) . '-cat.' . $category->id . '.' . time();
        });
        static::updating(function ($category) {
            $category->slug = Str::slug($category->name) . '-cat.' . $category->id . '.' . time();
        });
    }

    public function getNameAttribute($value)
    {
        return Str::ucfirst($value);
    }

    public function getImagePathAttribute()
    {
        return asset("storage/images/categories/{$this->image}");
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
