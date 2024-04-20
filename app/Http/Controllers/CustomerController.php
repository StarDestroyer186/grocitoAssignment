<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Cities;
use App\Models\States;
use App\Models\Pincode;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customers::all();
        $states = States::all();
        $cities = Cities::all();
        $pincodes = Pincode::all();

        return view('components.dashboard', [
            'customers' => $customers,
            'states' => $states,
            'cities' => $cities,
            'pincodes' => $pincodes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('create-customer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = $request->customer;
        $state_id = $request->state;
        $city_id = $request->city;
        $pincode_id = $request->pincode;

        $query = Customers::create([
            'name'=> $customer,
            'state_id'=> $state_id,
            'city_id'=> $city_id,
            'pincode_id'=> $pincode_id,
        ]);

        if($query){
            return redirect('dashboard');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customers::find($id);
        $states = States::all();
        $cities = Cities::all();
        $pincodes = Pincode::all();
        return view('components.edit', [
            'customer' => $customer,
            'states' => $states,
            'cities' => $cities,
            'pincodes' => $pincodes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = $request->customer;
        $state = Customers::find($id);
        $state->update([
            'name'=> $customer,
            'state_id'=> $request->state,
            'city_id'=> $request->city,
            'pincode_id'=> $request->pincode,
        ]);
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state = Customers::findOrFail($id);
        $state->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully');
    }
}
