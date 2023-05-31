<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $phases = Phase::orderBy('name')->get();

        return view('home', [
            'phases' => $phases
        ]);
    }

    public function changePhase(Request $request) 
    {
        $phases = Phase::all();
        $activePhase = Phase::findOrFail($request->id);

        foreach ($phases as $phase){ 
          if($phase->id == $request->id) {
            $phase->active = 1;
          } else {
            $phase->active = 0;
          }

          $phase->save();
        }

        Alert::success('Phase ' . $activePhase->name . ' is selected now', '');

        return response()->json([
          'status' => 200,
          'message' => 'Phase changed successfully'
        ]);
    }
}
