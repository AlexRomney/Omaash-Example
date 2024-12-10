<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'username',
        'email',
        'password',
        'shipping_type',
        'international_address',
        'first_name',
        'last_name',
        'address',
        'city',
        'state',
        'zip',
        'contact_type',
        'contact_handle',
        'payment_type',
        'avatar',
        'banned'
    ];

    protected $hidden = [
        'password',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function submissions()
    {
        return $this->hasMany('App\Models\Submission', 'user_id');
    }
}
