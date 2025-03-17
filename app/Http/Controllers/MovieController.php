<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    public function index(): JsonResponse
    {
        $movies = Movie::with('coverPicture')->get();

        return response()->json($movies);
    }

    public function show($id): JsonResponse
    {
        $movie = Movie::with('coverPicture')->find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'Movie not found!'
            ],
                404
            );
        }
        return response()->json($movie);
    }

    public function remove($id): JsonResponse
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'Movie not found!'
            ],
                404
            );
        }
        $movie->delete();
        return response()->json(['message' => 'Movie successfully deleted!']);
    }
}
