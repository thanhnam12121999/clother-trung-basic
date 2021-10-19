<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";
    protected $fillable = [
        'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at'
    ];

    public $incrementing = false;

    public function getMessageAttribute()
    {
        $data = json_decode($this->data);
        return $data->message;
    }

    public function getLinkAttribute()
    {
        $data = json_decode($this->data);
        return $data->link;
    }

    public function getForAdminAttribute()
    {
        $data = json_decode($this->data);
        return $data->for_admin;
    }

    public function getTimeAttribute()
    {
        $data = json_decode($this->data);
        return $data->time;
    }
}
