<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadingRequest;
use App\Http\Requests\WaterReadingRequest;
use App\Http\Resources\ApartmentResource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\WaterReadingResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\Unit;
use App\Models\WaterReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Arr;

class WaterReadingController extends Controller
{
    public function index()
    {
        $previousMonth = date("F", strtotime ( '-2 month' , strtotime ( date("F") ) )) ;

        $readings = WaterReadingResource::collection(WaterReading::with(['unit','bill'])
                    ->whereHas('bill', function($query) use($previousMonth){
                        $query->where('month', $previousMonth);
                    })
                   
                    // ->join('units', 'water_readings.unit_id','=','units.id')
                    // ->join('bills', 'water_readings.bill_id','=','bill_id')
                    // ->select('water_readings.*')
                    // ->where('bills.month',$previousMonth)
                    // ->orderBy('units.unit_no')    
                    ->get()->sortBy(['unit.unit_no']));

        // return response()->json($readings);
        return Inertia::render(
            'Readings/Index',
            [
                'readings' => $readings
            ]
        );
    }
    public function create()
    {
        return Inertia::render(
            // FIXME: Check this view
            'Readings/Create copy',
            [
                'apartments' => ApartmentResource::collection(Apartment::all()),
                'units' => UnitResource::collection(Unit::all()),
            ]
        );
    }

    public function store(WaterReadingRequest $request)
    {
        $readings = json_decode($request->getContent(), true);
        $billId = $readings['bill_id'];

        $new_insert_array = array();
        foreach ($readings as $reading) {
            foreach ($reading as $key => $r) {
                $new_insert_array[] = array(
                    'unit_id' => $r['id'],
                    'bill_id' => $billId,
                    'previous' =>  $r['current'],
                    'current' => $r['present']
                );
            }
            $record = WaterReading::insert($new_insert_array);
            if ($record) {
                $bill = Bill::find($billId);
                $bill->update([
                    "status"=>1
                ]);
                return Redirect::route("bills.readings", $billId)->with('message', 'Water Reading edited successfully');
            } else {
                return Redirect::back()->with('message', 'Water Reading edited successfully');
            }
        }



    }

    public function show(WaterReading $reading)
    {
        $unit = $reading->unit()->first();
        $apartment = $unit->apartment()->first();
        $bill = $reading->bill()->first();

        return Inertia::render(
            'Readings/Invoice',
            [
                'reading' => $reading,
                'unit' => $unit,
                'bill' => $bill,
                'apartment' => $apartment,
            ]
        );
    }

    public function edit(WaterReading $reading)
    {
        // return  $reading->with(['unit','bill'])->first(); 
        return Inertia::render(
            'Readings/Edit',
            [
                'reading' => $reading->with(['unit','bill'])->first(),
            ]
        );
    }

    public function update(WaterReadingRequest $request, WaterReading $reading)
    {
        $reading->update($request->validated());

        return Redirect::route('readings.index')->with('message', 'Water Reading edited successfully');
    }

    public function updateReading(ReadingRequest $request, WaterReading $reading)
    {
        
        $reading->update($request->validated());

        return Redirect::route('readings.index')->with('message', 'Water Reading edited successfully');;
    }

    public function destroy(WaterReading $reading)
    {
        $reading->delete();
        return Redirect::back()->with('message', 'Water Reading deleted successfully');;
    }
}
