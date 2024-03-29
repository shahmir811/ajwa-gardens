<!DOCTYPE html>
<html>
<head>
    <title>Record Table</title>

    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            font-size: 12px;
            border: 1px solid black;
            padding: 8px 2px;
            text-align: center; /* Center align the text/content */
        }

        .info-container {
            display: table;
            width: 100%;
        }
        
        .row {
            display: table-row;
        }
        
        .column {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: left;
        }
                
    </style>

</head>
<body>

  <h1>Payment Schedule (Plot # {{ $allotment->plot->plot_no }})</h1>

    <div class="info-container">
        <div class="row">
            <div class="column">
                <h4>Customer Name</h4>
                <p>{{ $allotment->customer->name }}</p>
            </div>
            <div class="column">
                <h4>Plot No</h4>
                <p>{{ $allotment->plot->plot_no }} (Phase: {{ $allotment->phase->name }})</p>
            </div>
            <div class="column">
                <h4>Marla</h4>
                <p>{{ $allotment->plot->marla }} ({{ $allotment->plot->type }})</p>
            </div>
            <div class="column">
                <h4>Rate Per Marla</h4>
                <p>Rs {{ number_format($allotment->per_marla_rate) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <h4>Total Amount</h4>
                <p>Rs {{ number_format($allotment->total_amount) }}</p>
            </div>
            <div class="column">
                <h4>Down Payment</h4>
                <p>Rs {{ number_format($allotment->down_amount) }}</p>
            </div>
            <div class="column">
                <h4>Monthly Installments</h4>
                <p>Rs {{ number_format($allotment->monthly_amount) }}</p>
            </div>
            <div class="column">
                <h4>Total Months</h4>
                <p>{{ $allotment->total_months }}</p>
            </div>            
        </div>
        <div class="row">
            <div class="column">
                <h4>Received Amount</h4>
                <p>Rs {{ number_format($allotment->total_received_amount) }}</p>
            </div>
            <div class="column">
                <h4>Remaining Amount</h4>
                <p>Rs {{ number_format($allotment->total_remaining_amount) }}</p>
            </div>
            <div class="column">
                <h4>Installment Plan Started On</h4>
                <p>{{ date('d-m-Y', strtotime($allotment->starting_date)) }}</p>
            </div>
            <div class="column">
                <h4>Last Payment Received On</h4>
                <p>{{ date('d-m-Y', strtotime($allotment->last_payment_at)) }}</p>
            </div>            
        </div>

    </div> 

    @php
        $sumOfMonthlyInstallments = 0;
        $sumOfTotalAmountReceived = 0;
        $sumOfThreeOrSixMonthsAmount = 0;

        function getMonthlyRecord($obj, $actual_amount) {
            $record = json_decode(json_encode($obj), true);

            $amount_received = $record['amount_received'];
            $amount = $actual_amount;

            $remaining = "-";

            if (!$amount) {
                return $remaining;
            } else if ($amount > 0 && $amount_received && $amount_received > 0) {
                if ($amount_received === $amount) {
                    return $remaining;
                } else if ($amount_received < $amount) {
                    $remaining = $amount - $amount_received;
                    // return number_format($remaining, 2, '.', ',');
                    return number_format($remaining);
                } else {
                    $remaining = $amount_received - $amount;
                    // return "(" . number_format($remaining, 2, '.', ',') . ")";
                    return "(" . number_format($remaining) . ")";
                }
            } else {
                // return number_format($amount, 2, '.', ',');
                return number_format($amount);
            }
        }

        function getRemainingAmount($allotment_record, $current_month, $schedules) {
            $allotment = json_decode(json_encode($allotment_record), true);

            $total_amount = $allotment['total_amount'];
            $down_amount = $allotment['down_amount'];
            $amount_paid = 0;

            for ($index = 0; $index < $current_month; $index++) {
                if (isset($schedules[$index])) {
                    $amount_paid += $schedules[$index]['amount_received'];
                }
            }

            $remaining = $total_amount - $down_amount - $amount_paid;
            // return number_format($remaining, 2, '.', ',');
            return number_format($remaining);
        }


    @endphp
    
    <table>
        <thead>
            <tr>
                <th>SR #</th>
                <th>Date</th>
                <th>Amount Received</th>
                <th>Amount Received On</th>
                <th>Monthly Installments</th>
                <th>3 Months & Half Year Payment</th>
                <th>Remaining Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allotment->schedules as $key => $record)
            @php
              $sumOfMonthlyInstallments += $record->monthly_amount;
              $sumOfTotalAmountReceived += $record->amount_received; 
              $sumOfThreeOrSixMonthsAmount += $record->three_or_six_month ? $record->three_or_six_month : 0;
            @endphp

            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ date('d-m-Y', strtotime($record->date)) }}</td>
                <td>{{ $record->amount_received ? number_format($record->amount_received) : '-' }}</td>
                <td>{{ $record->amount_received_on ? date('d-m-Y', strtotime($record->amount_received_on)) : '-' }}</td>
                {{-- <td>{{ number_format($record->monthly_amount) }}</td> --}}
                <td>{{ getMonthlyRecord($record, $record->monthly_amount) }}</td>
                <td>{{ $record->three_or_six_month ? number_format($record->three_or_six_month) : '-' }}</td>
                {{-- <td>{{ number_format($allotment->total_remaining_amount) }}</td> --}}
                <td>{{ getRemainingAmount($allotment, $key, $allotment->schedules) }}</td>
            </tr>
            @endforeach
            <tr>
              <td></td>
              <td></td>
              <td>{{ number_format($allotment->total_received_amount) }}</td>
              <td></td>
              <td>{{ number_format($sumOfMonthlyInstallments - $sumOfTotalAmountReceived) }}</td>
              <td>{{ number_format($sumOfThreeOrSixMonthsAmount) }}</td>
              <td>{{ number_format($allotment->total_remaining_amount) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
