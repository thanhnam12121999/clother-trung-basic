<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "accounts";
    protected $guarded = "accounts";

    protected $fillable = [
        'email',
        'username',
        'password',
        'phone_number',
        'name',
        'gender',
        'date_of_birth',
        'avatar',
        'accountable_id',
        'accountable_type',
        'social_id',
        'social_type',
        'token'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function accountable()
    {
        return $this->morphTo();
    }
}
