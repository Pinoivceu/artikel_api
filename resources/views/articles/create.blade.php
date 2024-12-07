<!-- resources/views/articles/create.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Tambah Artikel</h1>

    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-medium mb-2">Judul Artikel</label>
            <input type="text" name="judul" id="judul" class="w-full p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="gambar" class="block text-gray-700 font-medium mb-2">Gambar Artikel</label>
            <input type="file" name="gambar" id="gambar" class="w-full p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="isi" class="block text-gray-700 font-medium mb-2">Isi Artikel</label>
            <textarea name="isi" id="isi" class="w-full p-3 border border-gray-300 rounded-md" rows="6" required></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700">Simpan Artikel</button>
    </form>
</div>

</body>
</html>
