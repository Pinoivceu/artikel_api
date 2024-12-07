<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'required|string'
        ]);

        $gambar_path = $request->file('gambar')->store('articles', 'public');

        Article::create([
            'judul' => $validated['judul'],
            'gambar' => $gambar_path,
            'isi' => $validated['isi'],
            'tanggal_upload' => now()
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    // Method lainnya...
}
