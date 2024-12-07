<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleWebController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'required|string'
        ]);

        // Menyimpan gambar ke storage
        $gambar_path = $request->file('gambar')->store('articles', 'public');

        // Menyimpan artikel ke database
        $article = Article::create([
            'judul' => $validated['judul'],
            'gambar' => $gambar_path,
            'isi' => $validated['isi'],
            'tanggal_upload' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'required|string'
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($article->gambar) {
                Storage::disk('public')->delete($article->gambar);
            }
            // Upload gambar baru
            $validated['gambar'] = $request->file('gambar')->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy(Article $article)
    {
        // Hapus gambar
        if ($article->gambar) {
            Storage::disk('public')->delete($article->gambar);
        }

        $article->delete();

        return redirect()->route('dashboard')->with('success', 'Artikel berhasil dihapus!');
    }
}