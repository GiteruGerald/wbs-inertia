<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaterReadingRequest;
use App\Http\Resources\UnitResource;
use App\Http\Resources\WaterReadingResource;
use App\Models\WaterReading;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WaterReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render(
            'Readings/Index',
            [
                'readings' => WaterReadingResource::collection(WaterReading::all())
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
            'Readings/Create',
            [
                'units' => UnitResource::collection(Unit::all()),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WaterReadingRequest $request)
    {
        $waterReading= WaterReading::create($request->validated());

        return Redirect::route('readings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaterReading  $waterReading
     * @return \Illuminate\Http\Response
     */
    public function show(WaterReading $waterReading)
    {
        return Inertia::render(
            'Readings/Show',
            [
                'reading' => $waterReading,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaterReading  $waterReading
     * @return \Illuminate\Http\Response
     */
    public function edit(WaterReading $waterReading)
    {
        return Inertia::render(
            'Readings/Show',
            [
                'reading' => $waterReading,
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
    public function update(WaterReadingRequest $request, WaterReading $waterReading)
    {
        $waterReading->update($request->validated());

        return Redirect::route('readings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaterReading  $waterReading
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaterReading $waterReading)
    {
        $waterReading->delete();
        return Redirect::route('readings.index');
    }
    }
}
