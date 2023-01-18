<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Http\Resources\ApartmentResource;
use App\Http\Resources\UnitResource;
use App\Models\Apartment;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $units = UnitResource::collection(
            Unit::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query
                        ->join('apartments', 'units.apartment_id', '=', 'apartments.id')
                        ->select('units.*')
                        ->where('unit_no', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                })
                ->with('apartment')
                ->get()
        );

        return Inertia::render(
            'Units/Index',
            [
                'units' => $units,
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
            'Units/Create',
            [
                'apartments' => ApartmentResource::collection(Apartment::all()),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {

        $units = json_decode($request->getContent(), true);
        foreach ($units as $unit) {
            foreach ($unit as $u) {
                Unit::create([
                    "unit_no" => $u['unit_no'],
                    "meter_no" => $u['meter_no'],
                    "type" => '1 bedroom',
                    'apartment_id' => $u['apartment_id']
                ]);
            }
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        return Inertia::render(
            'Units/Show',
            [
                'unit' => $unit,
                'readings' => $unit->readings()->latest()->get(),
                'apartment' => $unit->apartment()->first()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return Inertia::render(
            'Units/Edit',
            [
                'unit' => $unit,
                'apartments' => ApartmentResource::collection(Apartment::all())
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        $unit->update($request->validated());

        return Redirect::route('units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->readings()->delete();
        $unit->delete();
        return Redirect::back();
    }
}
