<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Consultation::where('society_id', operator: request()->user()->id)->with('doctor')->first();

        return response([
            'consultation' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'disease_history' => '',
            'current_symptoms' => 'required'
        ]);
        Consultation::create([
            'society_id' => request()->user()->id,
            'status' => 'pending',
            'disease_history' => $validated['disease_history'] ?? null,
            'current_symptoms' => $validated['current_symptoms'],
        ]);
        return response([
            'message' => 'Request consultation sent successful'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
