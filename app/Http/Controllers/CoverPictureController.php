<?php

namespace App\Http\Controllers;

use App\Models\CoverPicture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoverPictureController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'cover_text' => 'required|string|max:20',
            'movie_id' => 'required|integer',
        ]);
        $name = $validatedData['name'];
        CoverPicture::generateImage($name, $validatedData['cover_text']);

        $validatedData = array_merge($validatedData, ['path' => 'images/' . $name]);


        $coverPicture = CoverPicture::create($validatedData);
        return response()->json($coverPicture, 201);
    }

    public function remove($id): JsonResponse
    {
        $coverPicture = CoverPicture::find($id);

        if (!$coverPicture) {
            return response()->json([
                'message' => 'Cover picture not found!'
            ],
                404
            );
        }
        $coverPicture->delete();
        return response()->json(['message' => 'Cover picture successfully deleted!']);
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $coverPicture = CoverPicture::find($id);

        if (!$coverPicture) {
            return response()->json([
                'message' => 'Cover picture not found!'
            ],
                404
            );
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:60',
        ]);

        $coverPicture->update($validatedData);
        return response()->json($coverPicture);
    }
}
