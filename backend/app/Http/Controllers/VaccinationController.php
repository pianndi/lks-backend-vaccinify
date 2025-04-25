<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Vaccination;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Vaccination::where('society_id', request()->user()->id)->with('spot.regional', 'vaccinator', 'vaccine')->get();
        return response([
            'vaccinations' => [
                'first' => isset($data[0]) ? [
                    'queue' => $data[0]->id,
                    'dose' => $data[0]->dose,
                    'vaccination_date' => $data[0]->date,
                    'spot' => $data[0]->spot,
                    'status' => Carbon::parse($data[0]->date)->diffInDays(Carbon::now()) < 30 ? 'registered' : 'vaccinated',
                    'vaccine' => $data[0]->vaccine,
                    'vaccinator' => $data[0]->vaccinator,
                ] : null,
                'second' => isset($data[1]) ? [
                    'queue' => $data[1]->id,
                    'dose' => $data[1]->dose,
                    'vaccination_date' => $data[1]->date,
                    'spot' => $data[1]->spot,
                    'status' => Carbon::parse($data[1]->date)->diffInDays(Carbon::now()) < 30 ? 'registered' : 'vaccinated',
                    'vaccine' => $data[1]->vaccine,
                    'vaccinator' => $data[1]->vaccinator,
                ] : null,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'date' => 'date_format:Y-m-d',
            'spot_id' => 'required'
        ]);
        $consultation = Consultation::where('society_id', request()->user()->id)->where('status', 'accepted')->first();
        $first_vaccine = Vaccination::orderBy('date', 'desc')->first();
        $end_days = Carbon::parse($validated['date']);
        if (Carbon::parse($first_vaccine->date)->diffInDays($end_days) < 30) {
            return response(content: [
                'message' => 'Wait at least +30 days from 1st Vaccination'
            ]);
        }
        if (!$consultation) {
            return response([
                'message' => 'Your consultation must be accepted by doctor before'
            ]);
        }
        $vaccination_total = Vaccination::where('society_id', request()->user()->id)->count();
        if ($vaccination_total >= 2) {
            return response([
                'messge' => 'Society has been 2x vaccinated'
            ]);
        }
        Vaccination::create([
            'spot_id' => request('spot_id'),
            'date' => request('date'),
            'society_id' => request()->user()->id
        ]);
        return response([
            'message' => ($vaccination_total == 1 ? 'Second' : 'First') . ' vaccination registered successful',
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
