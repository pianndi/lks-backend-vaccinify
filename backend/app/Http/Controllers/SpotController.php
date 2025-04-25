<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Spot::where('regional_id', request()->user()->regional_id)->with('spotVaccine.vaccine')->get();
        return response([
            'spots' => $data->map(function ($spot) {

                $available_vaccines = $spot->spotVaccine->map(fn($spotVaccine) => $spotVaccine->vaccine->name)->toArray();
                $default_vaccines = [
                    'Sinovac' => false,
                    'AstraZaneca' => false,
                    'Moderna' => false,
                    'Pfizer' => false,
                    'Sinnopharm' => false,
                ];
                foreach ($default_vaccines as $v => $_) {
                    if (in_array($v, $available_vaccines)) {
                        $default_vaccines[$v] = true;
                    }
                }
                return [
                    'id' => $spot->id,
                    'name' => $spot->name,
                    'address' => $spot->address,
                    'serve' => $spot->serve,
                    'capacity' => $spot->capacity,
                    'available_vaccines' => $default_vaccines,
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Spot::find($id);
        return response([
            'date' => Carbon::parse(request()->query('date'))->format('F d, Y'),
            'spot' => $data,
            'vaccinations_count' => intval($data->vaccinations()->where('date', request()->query('date'))->sum('dose'))
        ]);
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
