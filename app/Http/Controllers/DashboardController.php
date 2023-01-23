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
    public function index()
    {

        $totalApartments = Apartment::all()->count();
        $totalUnits = Unit::all()->count();
        $latestBills = Bill::query()->with('apartment')->latest('created_at')->get();

        return Inertia::render('Dashboard', [

            'totalApartments' => $totalApartments,
            'totalUnits' => $totalUnits,
            'latestBills' => $latestBills,
        ]);
    }
}
