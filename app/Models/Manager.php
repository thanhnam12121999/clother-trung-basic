<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manager extends Model
{
    use HasFactory;
    use SoftDeletes;

    CONST NAME_ROLE_MANAGER = 'manager';
    CONST NAME_ROLE_ADMIN = 'admin';
    CONST NAME_ROLE_STAFF = 'staff';
    protected $table = "managers";
    protected $fillable = [
        'role'
    ];

    public function account()
    {
        return $this->morphOne(Account::class, 'accountable');
    }
}
