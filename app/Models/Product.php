<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "products";
    protected $fillable = [
        'category_id',
        'name',
        'code',
        'feature_image',
        'summary',
        'detail',
        'description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_product', 'product_id', 'attribute_value_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }

    public function variantImages()
    {
        return $this->hasManyThrough(
            ProductVariantImage::class,
            ProductVariant::class,
            'product_id',
            'product_variant_id',
            'id',
            'id'
        );
    }

    public function images()
    {
        return $this->hasMany(ProductVariantImage::class, 'product_id', 'id');
    }

}
