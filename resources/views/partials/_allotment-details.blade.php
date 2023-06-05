<div class="prl-10">
  <div class="ui grid">

    <div class="row">
      <div class="four wide column">
        <h3 class="ui header">Customer Name</h3>
      </div>
      <div class="four wide column">
        <p>{{ $allotment->customer->name }}</p>
      </div>
      <div class="four wide column">
        <h3 class="ui header">Plot No</h3>
      </div>
      <div class="four wide column">
        <p>{{ $allotment->plot->plot_no }} (Phase: {{ $allotment->phase->name }})</p>
      </div>      
    </div>
    
    <div class="row">
      <div class="four wide column">
        <h3 class="ui header">Marla</h3>
      </div>
      <div class="four wide column">
        <p>{{ $allotment->plot->marla }} ({{ $allotment->plot->type }})</p>
      </div>
      <div class="four wide column">
        <h3 class="ui header">Rate Per Marla</h3>
      </div>
      <div class="four wide column">
        <p>Rs {{ number_format($allotment->per_marla_rate) }}</p>
      </div>      
    </div>
    
    <div class="row">
      <div class="four wide column">
        <h3 class="ui header">Total Amount</h3>
      </div>
      <div class="four wide column">
        <p>Rs {{ number_format($allotment->total_amount) }}</p>
      </div>
      <div class="four wide column">
        <h3 class="ui header">Down Payment</h3>
      </div>
      <div class="four wide column">
        <p>Rs {{ number_format($allotment->down_amount) }}</p>
      </div>      
    </div>
    
    <div class="row">
      <div class="four wide column">
        <h3 class="ui header">Installements</h3>
      </div>
      <div class="four wide column">
        <p>Rs {{ number_format($allotment->monthly_amount) }}</p>
      </div>
      <div class="four wide column">
        <h3 class="ui header">Total Installments Months</h3>
      </div>
      <div class="four wide column">
        <p>{{ $allotment->total_months }}</p>
      </div>      
    </div>

    <div class="row">
      <div class="four wide column">
        <h3 class="ui header">Received Amount</h3>
      </div>
      <div class="four wide column">
        <p>Rs {{ number_format($allotment->total_received_amount) }}</p>
      </div>
      <div class="four wide column">
        <h3 class="ui header">Remaining Amount</h3>
      </div>
      <div class="four wide column">
        <p>Rs {{ number_format($allotment->total_remaining_amount) }}</p>
      </div>      
    </div>
    

    <div class="row">
      <div class="four wide column">
        <h3 class="ui header">Installment Plan Started On:</h3>
      </div>
      <div class="four wide column">
        <p>{{ $allotment->starting_date }}</p>
      </div>
      <div class="four wide column">
        <h3 class="ui header">Last Payment Received On:</h3>
      </div>
      <div class="four wide column">
        <p>{{ $allotment->last_payment_at }}</p>
      </div>      
    </div>
        

  </div>
</div>