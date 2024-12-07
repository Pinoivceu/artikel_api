<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteWebController extends Controller
{
    public function index()
    {
        $quotes = Quote::latest()->get();
        return view('quotes.index', compact('quotes'));
    }

    public function create()
    {
        return view('quotes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string'
        ]);

        Quote::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Quote berhasil ditambahkan!');
    }

    public function edit(Quote $quote)
    {
        return view('quotes.edit', compact('quote'));
    }

    public function update(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'text' => 'required|string'
        ]);

        $quote->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Quote berhasil diupdate!');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('dashboard')
            ->with('success', 'Quote berhasil dihapus!');
    }
}