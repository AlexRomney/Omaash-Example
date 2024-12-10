<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'set_id',
        'card_id',
        'name',
        'number',
        'types',
        'artist',
        'rarity',
        'image_small',
        'image_large'
    ];

    protected $casts = ['types' => 'array'];

    public function set()
    {
        return $this->belongsTo('App\Models\Set');
    }

    public static function getCards($set)
    {
        $cards = self::with('set')->where('set_id', $set->id)->get(); 

        switch($set->set_id) {

            case 'sm115':
                $cards = $cards->merge(self::with('set')->where('set_id', $set->id + 1)->get());
            break;

            case 'swsh45':
                $cards = $cards->merge(self::with('set')->where('set_id', $set->id + 1)->get());
            break;

            case 'cel25':
                $cards = $cards->merge(self::with('set')->where('set_id', $set->id + 1)->get());
            break;

            case 'swsh9':
                $cards = $cards->merge(self::with('set')->where('set_id', $set->id + 1)->get());
            break;

            case 'swsh10':
                $cards = $cards->merge(self::with('set')->where('set_id', $set->id + 1)->get());
            break;

            case 'swsh11':
                $cards = $cards->merge(self::with('set')->where('set_id', $set->id + 1)->get());
            break;

            case 'swsh12':
                $cards = $cards->merge(self::with('set')->where('set_id', $set->id + 1)->get());
            break;

            case 'swsh12pt5':
                $cards = $cards->merge(self::with('set')->where('set_id', $set->id + 1)->get());
            break;
        }
        
        return $cards->sortBy('number');
    }
}
