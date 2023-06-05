<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'monthly_amount',
        'amount_received',
        'amount_received_on',
        'three_or_six_month',
        // 'remaining_amount',
        'allotment_id',
    ];

    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }        
}
