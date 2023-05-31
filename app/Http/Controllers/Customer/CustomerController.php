<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $customers;

      if($request->query('search')) {
        $column = $request->query('column');
        $search = $request->query('search');

        $queries;

        if($column == 'name' || $column == 'father_name') {
          $customers = Customer::where($column, 'like', '%' . $search . '%')->paginate(15);

        } else {
          $queries = array(
              $column => $search,
          );
          $customers = Customer::where($queries)->paginate(15);
        
        }


      } else {
        $customers = Customer::orderBy('name','asc')->paginate(15);
      }
      return view('customers.index')->with('customers',$customers);        
    }


    public function create()
    {
      return view('customers.create');
    }


    public function store(Request $request)
    {
      $request->validate([
        'name'        => ['required', 'string', 'max:255'],
        'cnic'        => ['required', 'string', 'digits:13', 'unique:customers'],
        'contact'     => ['required', 'string'],
        'father_name' => ['required', 'string'],
        'address'     => ['required', 'string'],
      ]);

      $customer               = new Customer;
      $customer->name         = $request->name;
      $customer->cnic         = $request->cnic;
      $customer->contact      = $request->contact;
      $customer->father_name  = $request->father_name;
      $customer->address      = $request->address;
      $customer->save();

      Alert::success('Customer created successfully', '');

      return redirect()->route('customers.index');
    }


    public function show(Customer $customer)
    {
        //
    }


    public function edit(Customer $customer)
    {
      $mentionedCustomer = Customer::findOrFail($customer->id);
      return view('customers.edit')->with('customer',$mentionedCustomer);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
      $request->validate([
          'name'        => 'required|string|max:255',
          'cnic'        => "required|string|digits:13|unique:customers,cnic," . $customer->id,
          'contact'     => "required|string",
          'father_name' => "required|string",
          'address'     => "required|string"
      ]);

      $customer               = Customer::findOrFail($customer->id);
      $customer->name         = $request->name;
      $customer->cnic         = $request->cnic;
      $customer->contact      = $request->contact;
      $customer->father_name  = $request->father_name;
      $customer->address      = $request->address;      
      $customer->save();

      Alert::success('Customer details updated successfully', '');      

      return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
