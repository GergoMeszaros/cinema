<?php

namespace App\Http\Controllers;

use App\Models\ShowtimeDetails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowtimeDetailsController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'showtime' => 'required|date_format:Y-m-d H:i',
            'available_seats' => 'required|integer|max:100',
            'movie_id' => 'required|integer',
        ]);

        $showtimeDetails = ShowtimeDetails::create($validatedData);
        return response()->json($showtimeDetails, 201);
    }

    public function remove($id): JsonResponse
    {
        $showtimeDetails = ShowtimeDetails::find($id);

        if (!$showtimeDetails) {
            return response()->json([
                'message' => 'Showtime details not found!'
            ],
                404
            );
        }
        $showtimeDetails->delete();
        return response()->json(['message' => 'Showtime details successfully deleted!']);
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $showtimeDetails = ShowtimeDetails::find($id);

        if (!$showtimeDetails) {
            return response()->json([
                'message' => 'Showtime details not found!'
            ],
                404
            );
        }

        $validatedData = $request->validate([
            'showtime' => 'sometimes|date_format:Y-m-d H:i',
            'available_seats' => 'sometimes|integer|max:100'
        ]);

        $showtimeDetails->update($validatedData);
        return response()->json($showtimeDetails);
    }
}
