<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "attributes";
    protected $fillable = [
        'name'
    ];

    public function getNameAttribute($value)
    {
        return Str::ucfirst($value);
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }
}
