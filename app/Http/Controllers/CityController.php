<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cities;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $cities = Cities::where('states_id', $id)->get();
        $stateId = $request->segment(2);
        return view('city.show', [
            'cities' => $cities,
            'stateId' => $stateId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $stateId = $request->input('stateId');
        Cities::create([
            "city" => $name,
            "states_id" => $stateId
        ]);
        return redirect()->back()->with('success', 'State deleted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = Cities::find($id);
        return view("city.edit", ["city" => $city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name = $request->name;
        $city = Cities::find($id);

        if ($city) {
            $city->city = $name;
            $city->save();
            return redirect('state')->with('success', 'City updated successfully');
        } else {
            return redirect('state')->with('error', 'City not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
