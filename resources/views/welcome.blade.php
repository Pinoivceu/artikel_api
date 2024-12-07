<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Welcome</title>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
   <nav class="bg-white shadow-lg">
       <div class="max-w-7xl mx-auto px-4">
           <div class="flex justify-between h-16">
               <div class="flex">
                   <div class="flex-shrink-0 flex items-center">
                       <span class="text-xl font-bold text-gray-800">Artikel & Quote</span>
                   </div>
               </div>
               <div class="flex items-center space-x-4">
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Login
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Register
                </a>
            @endif
        @endauth
    @endif
</div>
           </div>
       </div>
   </nav>

   <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <!-- Quote Section -->
           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
               <div class="p-6">
                   <h2 class="text-2xl font-semibold mb-4 text-center">Quote Hari Ini</h2>
                   @php
                       $quote = App\Models\Quote::latest()->first();
                   @endphp
                   @if($quote)
                       <p class="text-center text-lg text-gray-700 italic">
                           "{{ $quote->text }}"
                       </p>
                   @endif
               </div>
           </div>

           <!-- Articles Section -->
           <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6">
                   <h2 class="text-2xl font-semibold mb-4">Artikel Terbaru</h2>
                   <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                       @foreach(App\Models\Article::latest()->take(4)->get() as $article)
                           <div class="border rounded-lg overflow-hidden">
                               @if($article->gambar)
                                   <img src="{{ Storage::url($article->gambar) }}" 
                                        alt="{{ $article->judul }}"
                                        class="w-full h-48 object-cover">
                               @endif
                               <div class="p-4">
                                   <h3 class="font-semibold text-lg mb-2">{{ $article->judul }}</h3>
                                   <p class="text-gray-600 text-sm mb-2">
                                       {{ \Carbon\Carbon::parse($article->tanggal_upload)->format('d M Y') }}
                                   </p>
                                   <p class="text-gray-700 line-clamp-3">
                                       {{ Str::limit($article->isi, 150) }}
                                   </p>
                               </div>
                           </div>
                       @endforeach
                   </div>
               </div>
           </div>
       </div>
   </div>

   <footer class="bg-white shadow-lg mt-12">
       <div class="max-w-7xl mx-auto px-4 py-6">
           <p class="text-center text-gray-600">© {{ date('Y') }} Artikel & Quote. All rights reserved.</p>
       </div>
   </footer>
</body>
</html>