<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CharacterController extends Controller
{
    /**
     * Display a listing of the characters with optional filters.
     *
     * Supported query parameters: tier, element, weapon_type
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $characters = Character::query()
            ->when($request->has('tier'), function ($query) use ($request) {
                $query->where('tier', $request->query('tier'));
            })
            ->when($request->has('element'), function ($query) use ($request) {
                $query->where('element', $request->query('element'));
            })
            ->when($request->has('weapon_type'), function ($query) use ($request) {
                $query->where('weapon_type', $request->query('weapon_type'));
            })
            ->get();

        return response()->json($characters);
    }

    /**
     * Store a newly created character in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name_cn' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'tier' => 'required|string|max:10',
            'element' => 'required|string|max:100',
            'weapon_type' => 'required|string|max:100',
            'image_url' => 'nullable|url',
            'role' => 'required|string|max:100',
        ]);

        $character = Character::create($validated);

        return response()->json($character, 201);
    }

    /**
     * Display the specified character.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $character = Character::find($id);

        if (! $character) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        return response()->json($character);
    }

    /**
     * Update the specified character in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $character = Character::find($id);

        if (! $character) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        // Use sometimes to allow partial updates
        $rules = [
            'name_cn' => 'sometimes|string|max:255',
            'name_en' => 'sometimes|string|max:255',
            'tier' => 'sometimes|string|max:10',
            'element' => 'sometimes|string|max:100',
            'weapon_type' => 'sometimes|string|max:100',
            'image_url' => 'sometimes|nullable|url',
            'role' => 'sometimes|string|max:100',
        ];

        $validated = $request->validate($rules);

        $character->fill($validated);
        $character->save();

        return response()->json($character);
    }

    /**
     * Remove the specified character from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $character = Character::find($id);

        if (! $character) {
            return response()->json(['message' => 'Character not found'], 404);
        }

        $character->delete();

        return response()->json(null, 204);
    }
}
