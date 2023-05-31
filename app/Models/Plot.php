<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    use HasFactory;

    protected $fillable = [
        'plot_no',
        'marla',
        'type',
        'available',
        'corner_plot',
        'facing_park'
    ];    
}
