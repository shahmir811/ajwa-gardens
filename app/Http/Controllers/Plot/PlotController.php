<?php

namespace App\Http\Controllers\Plot;

use App\Http\Controllers\Controller;
use App\Models\Plot;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $plots;

        if($request->query('search')) {
            $column = $request->query('column');
            $search = $request->query('search');

            $queries = array(
                $column => $search,
            );
            $plots = Plot::where($queries)->orderBy('plot_no','asc')->paginate(15);            

        } else {
            $plots =  Plot::orderBy('plot_no','asc')->paginate(15);
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
            'marla'             => ['required', 'decimal:2',],
            'type'              => ['required'],
            'registration_no'   => ['required', 'string', 'unique:plots'],
            'form_no'           => ['required', 'string', 'unique:plots'],
        ]);

        $plot                   = new Plot;
        $plot->plot_no          = $request->plot_no;
        $plot->marla            = $request->marla;
        $plot->type             = $request->type;
        $plot->form_no          = $request->form_no;
        $plot->registration_no  = $request->registration_no;
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
            'marla'             => "required|decimal:2",
            'type'              => "required",
            'registration_no'   => "required|string|unique:plots,registration_no," . $plot->id,
            'form_no'           => "required|string|unique:plots,form_no," . $plot->id,
        ]);

        $plot                   = Plot::findOrFail($plot->id);
        $plot->plot_no          = $request->plot_no;
        $plot->marla            = $request->marla;
        $plot->type             = $request->type;
        $plot->form_no          = $request->form_no;
        $plot->registration_no  = $request->registration_no;
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
