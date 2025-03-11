<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestParking;
use App\Models\Reservations;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Parking;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Parking::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestParking $request)
    {
        $park = Parking::create($request->validated() + ['user_id' => Auth::id()]);
        return response()->json([
            'park' => $park
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $park = Parking::find($id);

        if(!$park) {
            return response()->json([
                'message' => 'Not Found!'
            ], 404);
        }

        return response()->json([
            'park' => $park
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $park = Parking::find($id);

        if(!$park) {
            return response()->json([
                'message' => 'Not Found!'
            ], 404);
        }

        $park->total_places = $request->input('total_places');
        $park->save();

        return response()->json([
            'park' => $park
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $park = Parking::find($id);

        if(!$park) {
            return response()->json([
                'message' => 'Not Found!'
            ], 404);
        }

        $reservations = Reservations::with('parking')->where('parking_id', $id)->get();
        foreach ($reservations as $reservation) {
            if($reservation['status'] == 'reserved' || $reservation['status'] == 'inThePark') {
                return response()->json([
                    'message' => 'the park has some reservations at the moments'
                ], 400);
            }
        }

        $park->delete();

        return response()->json([
            'message' => 'Parking Deleted'
        ]);
    }

    public function GetParkingAvalabiltiy(Request $request) {
        $word = $request->get('zone');

        $parkings = Parking::where('location', 'LIKE', "%$word%")->get();


        foreach ($parkings as $park) {
            $reservedCount = $park->reservation()->where('end_date', '>', now())->count();
            $park['available_slots'] = $park->total_places - $reservedCount;
        }

        return response()->json([
            'parkings' => $parkings
        ]);
    }

    public function getParkingStats()
    {
        $totalParkings = Parking::count();
        $totalPlaces = Parking::sum('total_places');
        $activeReservations = Reservations::where('end_date', '>', now())->count();
        $occupiedPlaces = $activeReservations;
        $occupationRate = $totalPlaces > 0 ? ($occupiedPlaces / $totalPlaces) * 100 : 0;

        return response()->json([
            'total_parkings' => $totalParkings,
            'total_places' => $totalPlaces,
            'active_reservations' => $activeReservations,
            'occupation_rate' => round($occupationRate, 2) . '%'
        ]);
    }
}
