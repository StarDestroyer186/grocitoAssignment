<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\States;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = States::all();
        return view("state.show", ['states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("state.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $state = States::create(["state"=> $name]);
        return redirect("state");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $state = States::find($id);
        return view("state", ["state"=> $state]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $state = States::find($id);
        return view('state.edit',['state' => $state]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name = $request->name;
        $state = States::find($id);
        $state->update(['state'=> $name]);
        return redirect('state');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state = States::findOrFail($id);
        $state->delete();
        return redirect()->back()->with('success', 'State deleted successfully');
    }
}
