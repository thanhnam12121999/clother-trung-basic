<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $primaryKey = "identifier";

    protected $table = "shoppingcart";
    protected $fillable = [
        'identifier',
        'instance',
        'content',
        'sub_total'
    ];

    public function getCartContentAttribute()
    {
        return json_decode($this->content, true);
    }
}
