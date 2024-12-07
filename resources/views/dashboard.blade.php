<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Message -->
            @if(session('success'))
            <div class="mb-6">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <!-- Search Bar -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <input type="text" id="search" 
                        class="w-1/2 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Cari artikel atau quote...">
                </div>
            </div>

            <!-- Daftar Artikel -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold">Daftar Artikel</h2>
                        <a href="{{ route('articles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Tambah Artikel
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Judul</th>
                                    <th class="px-6 py-3">Preview</th>
                                    <th class="px-6 py-3">Tanggal Upload</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Article::latest()->paginate(5) as $article)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ $article->judul }}</td>
                                    <td class="px-6 py-4">
                                        @if($article->gambar)
                                            <img src="{{ Storage::url($article->gambar) }}" 
                                                 alt="Preview" 
                                                 class="w-20 h-20 object-cover rounded">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">{{ $article->tanggal_upload->format('d M Y') }}</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('articles.edit', $article) }}" 
                                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                                    onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ App\Models\Article::latest()->paginate(5)->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Quote -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold">Daftar Quote</h2>
                        <a href="{{ route('quotes.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            Tambah Quote
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Text</th>
                                    <th class="px-6 py-3">Tanggal Dibuat</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Quote::latest()->paginate(5) as $quote)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ $quote->text }}</td>
                                    <td class="px-6 py-4">{{ $quote->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('quotes.edit', $quote) }}" 
                                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('quotes.destroy', $quote) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                                    onclick="return confirm('Yakin ingin menghapus quote ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ App\Models\Quote::latest()->paginate(5)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk search -->
    <script>
        const searchInput = document.getElementById('search');
        searchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>
</x-app-layout>