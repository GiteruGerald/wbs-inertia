<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Bill;
use App\Models\Unit;
use App\Models\WaterReading;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){

        $totalApartments = Apartment::all()->count();
        $totalUnits = Unit::all()->count();
        $latestBills = Bill::query()->latest('created_at')->get();
        $latestReading = WaterReading::query()->latest('created_at')->first();

          
        // return response()->json($latestReading);
        return Inertia::render('Dashboard', [

            'totalApartments' => $totalApartments,
            'totalUnits' => $totalUnits,
            'latestBills' => $latestBills,
            'latestReading'=> $latestReading,
        ]);
    }
}
