<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::latest()->get();
        return response()->json([
            'message' => 'Berhasil mendapatkan data quote',
            'data' => $quotes
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string'
        ]);

        $quote = Quote::create($validated);

        return response()->json([
            'message' => 'Quote berhasil ditambahkan',
            'data' => $quote
        ], 201);
    }

    public function show(Quote $quote)
    {
        return response()->json([
            'message' => 'Berhasil mendapatkan detail quote',
            'data' => $quote
        ]);
    }

    public function update(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'text' => 'required|string'
        ]);

        $quote->update($validated);

        return response()->json([
            'message' => 'Quote berhasil diupdate',
            'data' => $quote
        ]);
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return response()->json([
            'message' => 'Quote berhasil dihapus'
        ], 200);
    }
}
