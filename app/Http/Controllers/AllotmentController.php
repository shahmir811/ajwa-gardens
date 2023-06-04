<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\{Plot, Phase, Customer, Allotment, PaymentSchedule};
use Illuminate\Http\Request;
use App\Http\Requests\SaveNewAllotment;

class AllotmentController extends Controller
{

    private $currentPhase;

    public function __construct()
    {
        $this->currentPhase = Phase::where('active', '=', 1)->first();
    }    

    public function index(Request $request)
    {
      $allotments;

      if($request->query('search')) {
        $column = $request->query('column');
        $search = $request->query('search');

        $queries;

        // dd($column);

        if($column == 'plot_no') {
          $actual_plot = Plot::where('plot_no', '=', $search)->first();
          if($actual_plot) {
            $allotments = Allotment::where('plot_id', '=', $actual_plot->id)
                        ->paginate(15);
          } else {
            $allotments = [];
          }
              
        
        } else if($column == 'name') {
          $actual_customer_ids = Customer::where('name', 'like', '%' . $search . '%')->pluck('id')->toArray();
          $allotments = Allotment::where('phase_id', '=', $this->currentPhase->id)
                              ->whereIn('customer_id', $actual_customer_ids)->paginate(15);
        
        } else {
          $queries = array(
              $column => $search,
          );
          $allotments = Allotment::where($queries)->paginate(15);          
        }


        
      } else {
        $allotments = Allotment::where('phase_id', '=', $this->currentPhase->id)
                        ->paginate(15);
      }

      // $allotments = Allotment::where('phase_id', '=', $this->currentPhase->id)
      //                 ->paginate(15);

      return view('allotment.index', [
          'allotments' => $allotments
      ]);
    }

    public function create ()
    {
        $customers = Customer::all();
        $plots = Plot::where('phase_id', '=', $this->currentPhase->id)
                      ->where('available', '=', 1)->get();

        return view('allotment.create', [
            'customers' => $customers,
            'plots' => $plots
        ]);
    }

    public function store(SaveNewAllotment $request) 
    {
        DB::transaction(function () use ($request) {

          $allotment                          = new Allotment;
          $allotment->phase_id                = $this->currentPhase->id;
          $allotment->customer_id             = $request->customer_id;
          $allotment->plot_id                 = $request->plot_id;
          $allotment->total_amount            = $request->total_amount;
          $allotment->down_amount             = $request->down_amount;
          $allotment->monthly_amount          = $request->monthly_amount;
          $allotment->per_marla_rate          = $request->per_marla_rate;
          $allotment->total_months            = $request->total_months; 
          $allotment->three_months_amount     = $request->three_months_amount;          
          $allotment->six_months_amount       = $request->six_months_amount;
          $allotment->starting_date           = $request->starting_date;
          $allotment->registration_no         = $request->registration_no;
          $allotment->form_no                 = $request->form_no;
          $allotment->total_received_amount   = $request->down_amount;
          $allotment->total_remaining_amount  = $request->total_amount - $request->down_amount;
          $allotment->last_payment_at         = $request->starting_date;
          $allotment->save();

          foreach ($request->paymentSchedule as $record){ 
            $schedule                     = new PaymentSchedule;
            $schedule->date               = Carbon::createFromFormat('d-m-Y', $record['date'])->format('Y-m-d');
            $schedule->monthly_amount     = $record['monthly_amount'];
            $schedule->allotment_id       = $allotment->id;
            $schedule->remaining_amount   = $record['remaining_amount'];
            $schedule->three_or_six_month = $this->getThreeOrSixMonthColumnValue($record);
            $schedule->save();

          }

          $plot             = Plot::findOrFail($request->plot_id);
          $plot->available  = 0;
          $plot->save();
        

        });        

        return response() -> json([
            'status' => 1,
            'message' => 'Allotment data saved successfully',
        ], 200);      

    }

    public function view($id)
    {
      $allotment = Allotment::findOrFail($id);
      return view('allotment.view', [
          'allotment' => $allotment,
      ]);      
    }

    private function getThreeOrSixMonthColumnValue($data)
    { 
      if($data['id'] == 3) {
        return $data['three_months_amount'];
      
      } else if ($data['id'] % 6 == 0) {
        return $data['six_months_amount'];
      
      } else {
        return 0;
      }
    }
}
