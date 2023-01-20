<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentRequest;
use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apartments = Apartment::query()
            ->when($request->input('search'), function($query, $search){
                $query->where('name','like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($apartment)=>[
                'id' => $apartment->id,
                'name' => $apartment->name,
                'location' => $apartment->location,
                'units' => $apartment->units()->count(),
            ]);

        // return response()->json($apartments);
        return Inertia::render('Apartments/Index',
        [
            // 'apartments' => ApartmentResource::collection(Apartment::all()),
            'apartments' => $apartments,
            'filters' => $request->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Apartments/Create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentRequest $request)
    {
        $apartment = Apartment::create($request->validated());

        return Redirect::route('apartments.show', $apartment->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return Inertia::render('Apartments/Show',
        [
            'apartment'=> $apartment,
            'unitsCount'=>$apartment->units()->count(),
            'units' => $apartment->units()->get()
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return Inertia::render('Apartments/Edit',
        [
            'apartment'=> $apartment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        $apartment->update($request->validated());

        return Redirect::route('apartments.index'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {

         $apartment->readings()->delete();
        $apartment->units()->delete();
        $apartment->delete();
        return Redirect::route('apartments.index'); 

    }

    public function getUnitsByApartment(Apartment $apartment)
    {
        // FIXME: how to pass in previous water reading based on current month
        $currentMonth = date('F');
        $previousMonth = date("F", strtotime ( '-1 month' , strtotime ( $currentMonth ) )) ;
        $bill = $apartment->bills()->where('month',$previousMonth)->get();
        return response()->json($bill);
                // return response()->json([$currentMonth, $newdate]);

         $units = Unit::
                        join('water_readings','units.id','=','water_readings.unit_id')
                        ->select('units.*','water_readings.previous')
                        ->where('apartment_id',$apartment->id)
                        ->latest()->get();
         return response()->json($units);
    }
}
