<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillRequest;
use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

// TODO: IMplement a Queue to create bill details every month
class BillsController extends Controller
{
    /**
 * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bills = Bill::query()
                    ->when($request->input('search'), function($query, $search){
                        $query->where('month', 'like', "%{$search}%");  
                    })
                    ->paginate(10)
                    ->through(fn($bill)=>[
                        'id'=>$bill->id,
                        'month'=>$bill->month,
                        'rate'=>$bill->rate,
                    ]);
        return Inertia::render('Bills/Index',
        [
            'bills' => $bills
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Bills/Create',[
            'apartments' => ApartmentResource::collection(Apartment::all()),

        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request)
    {
        
        Bill::create($request->validated());

        return Redirect::route('bills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        // return $bill;
        return Inertia::render('Bills/Show',
        [
            'bill'=> $bill,
            'apartment' => $bill->apartment()->first()

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        return Inertia::render('Bills/Edit',
        [
            'bill'=> $bill,
            'apartments' => ApartmentResource::collection(Apartment::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(BillRequest $request, Bill $bill)
    {
        $bill->update($request->validated());

        return Redirect::route('bills.index'); 
    }


}
