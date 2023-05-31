<?php

namespace App\Http\Controllers\Plot;

use App\Http\Controllers\Controller;
use App\Models\{Plot, Phase};
use Illuminate\Http\Request;

class PlotController extends Controller
{
    private $currentPhase;

    public function __construct()
    {
        $this->currentPhase = Phase::where('active', '=', 1)->first();
    }    

    public function index(Request $request)
    {
        $plots;

        if($request->query('search')) {
            $column = $request->query('column');
            $search = $request->query('search');

            $queries = array(
                $column => $search,
            );
            $plots = Plot::where('phase_id', '=', $this->currentPhase->id)
                            ->where($queries)->orderBy('plot_no','asc')->paginate(15);            

        } else {
            $plots =  Plot::where('phase_id', '=', $this->currentPhase->id)
                        ->orderBy('plot_no','asc')->paginate(15);
        }
        return view('plots.index')->with('plots',$plots);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plot_no'           => ['required', 'string', 'unique:plots'],
            // 'plot_no' => [
            //     'required', 'string',
            //     function ($attribute, $value, $fail) {
                    
            //         // Checke if plot_no is unique in this phase
            //         $plot_exists = Plot::where('plot_no', '=',$value)->where('phase_id', '=', $this->currentPhase->id)->count() > 0;

            //         if ($plot_exists) {
            //             // $fail('The '.$attribute.' must be unique in this phase.' . $this->currentPhase->id);
            //             $fail('The plot number already exists in this phase ' . $this->currentPhase->id);
            //         }
            //     }
            // ],            
            'marla'             => ['required', 'decimal:3',],
            'type'              => ['required'],
            'corner_plot'       => ['required'],
            'facing_park'       => ['required'],                        
        ]);

        $plot                   = new Plot;
        $plot->plot_no          = $request->plot_no;
        $plot->marla            = $request->marla;
        $plot->type             = $request->type;
        $plot->corner_plot      = $request->corner_plot; 
        $plot->facing_park      = $request->facing_park;   
        $plot->phase_id         = $this->currentPhase->id;
        $plot->save();

        return redirect()->route('plots.index');        
    }

    /**
     * Display the specified resource.
     */
    public function show(Plot $plot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plot $plot)
    {
        $mentionedPlot = Plot::findOrFail($plot->id);
        return view('plots.edit')->with('plot',$mentionedPlot);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plot $plot)
    {
        $request->validate([
            'plot_no'           => "required|string|unique:plots,plot_no," . $plot->id,
            'marla'             => "required|decimal:3",
            'type'              => "required",
            'corner_plot'       => "required",
            'facing_park'       => "required",
        ]);

        $plot                   = Plot::findOrFail($plot->id);
        $plot->plot_no          = $request->plot_no;
        $plot->marla            = $request->marla;
        $plot->type             = $request->type;
        $plot->corner_plot      = $request->corner_plot;     
        $plot->facing_park      = $request->facing_park;                 
        $plot->save();

        return redirect()->route('plots.index');                

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plot $plot)
    {
        //
    }
}
