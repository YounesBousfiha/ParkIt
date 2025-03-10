<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestReservation;
use App\Http\Requests\UpdateRequestReservation;
use App\Jobs\UpdateParkingAvailability;
use App\Models\Parking;
use App\Models\Reservations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'reservations' => Reservations::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestReservation $request)
    {
        $data = $request->validated();

        $reservation = Reservations::create($data + ['user_id' => Auth::id()]);

        $end_date = Carbon::parse($reservation->end_date);
        $delay = now()->diffInSeconds($end_date);
        UpdateParkingAvailability::dispatch($reservation)->delay(now()->addSeconds($delay));

        return response()->json([
            'reservation' => $reservation
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservations::find($id);

        if(!$reservation) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }

        return response()->json([
            'reservation' => $reservation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestReservation $request, string $id)
    {
        $request->validated();

        $reservation = Reservations::find($id);

        if(!$reservation) {
            return response()->json([
                'message' => 'Not Found!'
            ], 404);
        }

        if($reservation['status'] != 'Done' || $reservation['status'] != 'Canceled') {
            $reservation['start_date'] = $request->start_date;
            $reservation['end_date'] = $request->end_date;
            $reservation->save();
        }

        return response()->json([
            'reservation' => $reservation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservations::find($id);

        if(!$reservation) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }

        $reservation['status'] = 'canceled';
        $reservation->save();

        return response()->json([
            'message' => 'reservation Canceled!'
        ]);
    }

    public function myReservation() {
        $user_id = Auth::id();

        $reservation = Reservations::with('user')->where('user_id', $user_id)->get();

        //$reservation = Reservations::with('user_id', $user_id)->get();

        return response()->json([
            'MyReservation' => $reservation
        ]);
    }
}
