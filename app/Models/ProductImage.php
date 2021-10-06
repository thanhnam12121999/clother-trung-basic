<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "product_images";
    protected $fillable = [
        'product_id',
        'image'
    ];

    // public function variants()
    // {
    //     return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    // }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
