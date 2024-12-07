<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return response()->json([
            'message' => 'Berhasil mendapatkan data artikel',
            'data' => $articles
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'required|string'
        ]);

        $gambar_path = $request->file('gambar')->store('articles', 'public');

        $article = Article::create([
            'judul' => $validated['judul'],
            'gambar' => $gambar_path,
            'isi' => $validated['isi'],
            'tanggal_upload' => now()
        ]);

        return response()->json([
            'message' => 'Artikel berhasil ditambahkan',
            'data' => $article
        ], 201);
    }

    public function show(Article $article)
    {
        return response()->json([
            'message' => 'Berhasil mendapatkan detail artikel',
            'data' => $article
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'judul' => 'string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'string'
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::disk('public')->delete($article->gambar);
            $validated['gambar'] = $request->file('gambar')->store('articles', 'public');
        }

        $article->update($validated);

        return response()->json([
            'message' => 'Artikel berhasil diupdate',
            'data' => $article
        ]);
    }

    public function destroy(Article $article)
    {
        Storage::disk('public')->delete($article->gambar);
        $article->delete();

        return response()->json([
            'message' => 'Artikel berhasil dihapus'
        ], 200);
    }
}