<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manager extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "managers";
    protected $fillable = [
        'role'
    ];

    public function account()
    {
        return $this->morphOne(Account::class, 'accountable');
    }
}
