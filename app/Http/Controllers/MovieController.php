<?php

namespace App\Http\Controllers;

use App\Enum\Language;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function edit(Request $request, $id): JsonResponse
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'Movie not found!'
            ],
                404
            );
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:60',
            'description' => 'sometimes|string|max:500',
            'language' => ['sometimes','in:' . implode(',', Language::languages())],
            'age_restriction' =>'sometimes|integer'
        ]);

        $movie->update($validatedData);

        return response()->json($movie);
    }
}
