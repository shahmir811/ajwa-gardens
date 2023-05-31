<?php

namespace App\Http\Controllers;

use App\Models\{Plot, Phase, Customer};
use Illuminate\Http\Request;

class AllotmentController extends Controller
{

    private $currentPhase;

    public function __construct()
    {
        $this->currentPhase = Phase::where('active', '=', 1)->first();
    }    

    public function index()
    {
        $customers = Customer::all();
        $plots = Plot::where('phase_id', '=', $this->currentPhase->id)
                      ->where('available', '=', 1)->get();

        return view('allotment.index', [
            'customers' => $customers,
            'plots' => $plots
        ]);
    }
}
