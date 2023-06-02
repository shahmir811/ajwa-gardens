<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveNewAllotment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'phase_id'              => 'required',
            'customer_id'           => 'required',
            'plot_id'               => 'required',
            'total_amount'          => 'required',
            'down_amount'           => 'required',
            'monthly_amount'        => 'required',
            'per_marla_rate'        => 'required',
            'three_months_amount'   => 'required',
            'six_months_amount'     => 'required',
            // 'months_count'          => 'required',
            'starting_date'         => 'required|date',
            'registration_no'       => 'required|unique:allotments,registration_no',
            'form_no'               => 'required|unique:allotments,form_no',
        ];
    }
}
