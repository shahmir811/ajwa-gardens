<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allotment extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase_id', 
        'customer_id',
        'plot_id',
        'total_amount',
        'down_amount',
        'monthly_amount',
        'per_marla_rate',
        'three_months_amount',
        'six_months_amount',
        'total_months',
        'starting_date',
        'registration_no',
        'form_no',
        'total_received_amount',
        'total_remaining_amount',
        'last_payment_at'
    ];  
    
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }     
    
    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }         

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }   
    
    public function schedules()
    {
        return $this->hasMany(PaymentSchedule::class);
    }
}
