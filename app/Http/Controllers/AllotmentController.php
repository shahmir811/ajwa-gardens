<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\SaveNewAllotment;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\{Plot, Phase, Customer, Allotment, PaymentSchedule, Message};

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

          $allotment                                        = new Allotment;
          $allotment->phase_id                              = $this->currentPhase->id;
          $allotment->customer_id                           = $request->customer_id;
          $allotment->plot_id                               = $request->plot_id;
          $allotment->total_amount                          = $request->total_amount;
          $allotment->down_amount                           = $request->down_amount;
          $allotment->monthly_amount                        = $request->monthly_amount;
          $allotment->per_marla_rate                        = $request->per_marla_rate;
          $allotment->total_months                          = $request->total_months; 
          $allotment->three_months_amount                   = $request->three_months_amount;          
          $allotment->six_months_amount                     = $request->six_months_amount;
          $allotment->starting_date                         = $request->starting_date;
          $allotment->registration_no                       = $request->registration_no;
          $allotment->form_no                               = $request->form_no;
          $allotment->total_received_amount                 = $request->down_amount;
          $allotment->total_remaining_amount                = $request->total_amount - $request->down_amount;
          $allotment->last_payment_at                       = $request->starting_date;
          $allotment->down_payment_mode                     = $request->down_payment_mode;
          $allotment->down_payment_bank_receipt_no          = $request->down_payment_bank_receipt_no;
          $allotment->down_payment_receipt_no               = Carbon::now()->timestamp;
          $allotment->save();

          foreach ($request->paymentSchedule as $record){ 
            $schedule                     = new PaymentSchedule;
            $schedule->date               = Carbon::createFromFormat('d-m-Y', $record['date'])->format('Y-m-d');
            $schedule->monthly_amount     = $record['monthly_amount'];
            $schedule->allotment_id       = $allotment->id;
            // $schedule->remaining_amount   = $record['remaining_amount'];
            $schedule->three_or_six_month = $this->getThreeOrSixMonthColumnValue($record);
            $schedule->save();

          }

          $plot             = Plot::findOrFail($request->plot_id);
          $plot->available  = 0;
          $plot->save();

          $description = "Dear valued customer, we have received Rs " . $allotment->down_amount . " as a booking amount.\nThanks, Ajwa Gardens";

          $phone_number = preg_replace('/\D+/', '', $allotment->customer->contact);

          $record = [
            'description' => $description,
            'phone_number' => $phone_number
          ];

          $message = new Message;
          $message->insertMessage($record);        

          $zaffar_number = Config::get('customvariables.zaffar_bhai_contact');
          $zaffar_number = preg_replace('/\D+/', '', $zaffar_number);
          $new_description = "You have received Rs " . $allotment->down_amount .  " as a booking amount.\nThanks, Ajwa Gardens";

          $record = [
            'description'   => $new_description,
            'phone_number'  => $zaffar_number
          ];

          $message->insertMessage($record);          
        

        });  
        
        
        Alert::success('New allotment has been created');          

        return response() -> json([
            'status' => 1,
            'message' => 'Allotment data saved successfully',
        ], 200);      

    }

    public function view($id)
    {

      $title = 'Delete Allotment!';
      $text = "Are you sure you want to delete this allotment?";
      confirmDelete($title, $text);      

      $allotment = Allotment::findOrFail($id);
      return view('allotment.view', [
          'allotment' => $allotment,
          'role' => Auth::user()->role->name,
      ]);      
    }

    public function receivedMonthlyInstallment(Request $request, $id)
    {

      DB::transaction(function () use ($request, $id) {

        $year = date('Y', strtotime($request->date));
        $month = date('m', strtotime($request->date));

        $schedule                       = PaymentSchedule::where('allotment_id', '=', $id)
                                                        ->whereYear('date', '=', $year)
                                                        ->whereMonth('date', '=', $month)
                                                        ->first();
        $schedule->amount_received      += $request->amount;
        $schedule->amount_received_on   = $request->date;
        $schedule->payment_mode         = $request->payment_mode;
        $schedule->bank_receipt_no      = $request->bank_receipt_no;
        $schedule->receipt_no           = Carbon::now()->timestamp;
        $schedule->save();
  
        $allotment                          = Allotment::findOrFail($schedule->allotment_id);
        $allotment->total_received_amount   += $request->amount;
        $allotment->total_remaining_amount  -= $request->amount;
        $allotment->last_payment_at         = $request->date;
        $allotment->save();

        $description = "Dear valued customer, we have received Rs " . $request->amount . " as an instalment amount.\nThanks, Ajwa Gardens";

        $phone_number = preg_replace('/\D+/', '', $allotment->customer->contact);

        $record = [
          'description' => $description,
          'phone_number' => $phone_number
        ];

        $message = new Message;
        $message->insertMessage($record);        

        $zaffar_number = Config::get('customvariables.zaffar_bhai_contact');
        $zaffar_number = preg_replace('/\D+/', '', $zaffar_number);
        $new_description = "You have received Rs " . $request->amount .  " as an instalment amount.\nThanks, Ajwa Gardens";

        $record = [
          'description'   => $new_description,
          'phone_number'  => $zaffar_number
        ];

        $message->insertMessage($record);


      });     
      
      Alert::success('Rs ' . $request->amount .' has been received as monthly installment', '');      


      return response() -> json([
          'status' => 1,
          'message' => 'Monthly installment Received',
      ], 200);            

    }

    public function removeInstallment($id)
    {

      DB::transaction(function () use ($id) {

        $amount;
        $allotment_id;

        $schedule                     = PaymentSchedule::findOrFail($id);
        $allotment_id                 = $schedule->allotment_id;
        $amount                       = $schedule->amount_received;
        $schedule->amount_received    = 0;
        $schedule->payment_mode       = "";
        $schedule->receipt_no         = "";
        $schedule->amount_received_on = null;

        $schedule->save();

        $allotment                          = Allotment::findOrFail($allotment_id);
        $allotment->total_received_amount   -= $amount;
        $allotment->total_remaining_amount  += $amount;
        $allotment->save();

      }); 

      Alert::success('Record has been removed successfully', '');

      return response() -> json([
          'status' => 1,
          'message' => 'Monthly installment has been removed successfully',
      ], 200);            


    }

    public function removeAllotment($id)
    {
      DB::transaction(function () use ($id) {

        $plot_id;

        $allotment = Allotment::findOrFail($id);
        $plot_id = $allotment->plot_id;

        foreach ($allotment->schedules as $schedule) {
          $schedule->delete();
        }

        $allotment->delete();

        $plot             = Plot::findOrFail($plot_id);
        $plot->available  = 1;
        $plot->save();

      }); 

      Alert::success('Allotment has been removed successfully', '');

      return redirect('/allotment');

    }

    public function printInstallmentSlip($id) 
    {
      $schedule = PaymentSchedule::findOrFail($id);
      $pdf = PDF::loadView('pdfs.paymentSlip',array('schedule' => $schedule));
      return $pdf->download('print_installment_slip.pdf');

    }

    public function printAllPayments($id) 
    {
      $allotment = Allotment::findOrFail($id);
      $pdf = PDF::loadView('pdfs.paymentSchedule',array('allotment' => $allotment));
      return $pdf->download('payment_schedule.pdf');
    }

    public function printDownPaymentSlip($id) 
    {
      $allotment = Allotment::findOrFail($id);
      $pdf = PDF::loadView('pdfs.downPaymentSlip',array('allotment' => $allotment));
      return $pdf->download('down_payment_slip.pdf');
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
