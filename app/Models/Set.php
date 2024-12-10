<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $fillable = [
        'set_id',
        'series',
        'name',
        'release_date',
        'release_year',
        'set_total',
        'secret_rares',
        'card_total',
        'image_symbol',
        'image_logo',
        'series_logo'
    ];

    public function cards()
    {
        return $this->hasMany('App\Models\Card', 'set_id');
    }
}
