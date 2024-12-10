<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'sub_id',
        'company',
        'service_level',
        'status',
        'number_of_cards',
        'needs_card_savers',
        'grading_fee',
        'my_fee',
        'shipping_fee',
        'card_saver_fee',
        'paid',
        'show_on_channel',
        'completed',
        'completed_date',
        'send_off_date',
        'tracking_number',
        'accepted_terms_date',
        'note',
        'expedited',
        'auction_off',
        'auction_company',
        'sold_amount',
        'payout'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
