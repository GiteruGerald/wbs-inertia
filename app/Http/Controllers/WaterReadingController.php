<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaterReadingRequest;
use App\Http\Resources\ApartmentResource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\WaterReadingResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\Unit;
use App\Models\WaterReading;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Arr;

class WaterReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return WaterReading::with('unit')->latest()->get();
        // return WaterReadingResource::collection(WaterReading::with('unit')->latest()->get());
        return Inertia::render(
            'Readings/Index',
            [
                'readings' => WaterReadingResource::collection(WaterReading::with('unit')->latest()->get())
                // 'readings' => WaterReading::with('unit')->latest()->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Readings/Create copy',
            [
                'apartments' => ApartmentResource::collection(Apartment::all()),
                'units' => UnitResource::collection(Unit::all()),
            ]
        );
    }
    // public function create()
    // {
    //     return Inertia::render(
    //         'Readings/Create',
    //         [
    //             'units' => UnitResource::collection(Unit::all()),
    //         ]
    //     );
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WaterReadingRequest $request)
    {
        $readings = json_decode($request->getContent(), true);
        $bill = $readings['bill_id'];
        $new_insert_array = array();
        foreach ($readings as $reading) {
            foreach ($reading as $key => $r) {
                $new_insert_array[] = array(
                    'unit_id' => $r['id'],
                    'bill_id' => $bill,
                    'previous' =>  $r['previous'],
                    'current' => $r['current']
                );
            }
            $record = WaterReading::insert($new_insert_array);
            if ($record) {
                return Redirect::route("bills.readings", $bill);
            } else {
                return Redirect::back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaterReading  $waterReading
     * @return \Illuminate\Http\Response
     */
    public function show(WaterReading $reading)
    {
        $unit = $reading->unit()->first();
        $apartment = $unit->apartment()->first();

        return Inertia::render(
            'Readings/Show',
            [
                'reading' => $reading,
                'unit' => $unit,
                'apartment' => $apartment,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaterReading  $reading
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterReading $reading)
    {
        return Inertia::render(
            'Readings/Edit',
            [
                'reading' => $reading,
                'units' => UnitResource::collection(Unit::all()),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WaterReading  $waterReading
     * @return \Illuminate\Http\Response
     */
    public function update(WaterReadingRequest $request, WaterReading $reading)
    {
        $reading->update($request->validated());

        return Redirect::route('readings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaterReading  $reading
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterReading $reading)
    {
        $reading->delete();
        return Redirect::back();
    }
}
