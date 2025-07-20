<?php

namespace App\Http\Controllers;

use App\Models\PlinkoPosition;
use Illuminate\Http\Request;

class PlinkoController extends Controller
{
    public function recordPosition(Request $request)
    {
        $request->validate([
            'position_x' => 'required|numeric',
            'bucket_index' => 'required|integer|min:0',
            'multiplier' => 'required|numeric',
            'rows' => 'required|integer|min:8|max:16'
        ]);

        try {
            $position = PlinkoPosition::create([
                'position_x' => $request->position_x,
                'bucket_index' => $request->bucket_index,
                'multiplier' => $request->multiplier,
                'rows' => $request->rows
            ]);

            return response()->json([
                'success' => true,
                'position_id' => $position->id,
                'message' => 'Позиция записана'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Ошибка записи в базу данных'
            ], 500);
        }
    }

    public function getLastPositions()
    {
        $positions = PlinkoPosition::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'positions' => $positions
        ]);
    }
}