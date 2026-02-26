<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Buku</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: "Poppins", sans-serif; }
  </style>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-white shadow px-6 py-4">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
      <h1 class="text-lg font-semibold">Pcg App</h1>
      <ul class="flex gap-4 text-sm text-gray-700">
        <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
        <li><a href="{{ route('categories') }}" class="hover:text-blue-600">Kategoris</a></li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold mb-6">Daftar Buku</h2>

    <!-- Grid Buku -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      
      <!-- Card Buku -->
      <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
        <img src="https://i.pinimg.com/736x/34/78/6b/34786b35b7dba66f8b98db24d586ba26.jpg" alt="bintang" class="w-full h-flex object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-lg">Boboboy Galaxy</h3>
          <p class="text-sm text-gray-600">by Mas Fadly</p>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
        <img src="https://i.pinimg.com/736x/0a/50/0d/0a500df275e3f3f5228b202e1c057677.jpg" alt="PHP" class="w-full h-flex object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-lg">Sepongbob</h3>
          <p class="text-sm text-gray-600">by Mas Jambron</p>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
        <img src="https://i.pinimg.com/1200x/84/91/9a/84919a401f732bd86e9e544a3a05a765.jpg" alt="MySQL" class="w-full h-flex object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-lg">The Simpsons</h3>
          <p class="text-sm text-gray-600">by Mas Justin </p>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
        <img src="https://i.pinimg.com/736x/43/47/a9/4347a9c4585cebb01b1fb8ff9c590a6e.jpg" alt="JavaScript" class="w-full h-flex object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-lg">Naruto Shippuden</h3>
          <p class="text-sm text-gray-600">by Mas Fatchur</p>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
        <img src="https://i.pinimg.com/1200x/32/5a/99/325a992cca82491d21f34e4a45210c08.jpg" alt="bintang" class="w-full h-flex object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-lg">Spiderman</h3>
          <p class="text-sm text-gray-600">by Mas Alex</p>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
        <img src="https://i.pinimg.com/736x/2d/a2/fb/2da2fbb61c085f393a055e07c7e64186.jpg" alt="PHP" class="w-full h-flex object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-lg">Doraemon</h3>
          <p class="text-sm text-gray-600">by Mas Dika</p>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
        <img src="https://i.pinimg.com/1200x/1e/41/63/1e416375f282bb79b6dbce61605048cd.jpg" alt="MySQL" class="w-full h-flex object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-lg">Batman</h3>
          <p class="text-sm text-gray-600">by Mas Pcgg </p>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
        <img src="https://i.pinimg.com/1200x/8f/45/b1/8f45b15792392e0852bfa2ecc5f77721.jpg" alt="JavaScript" class="w-full h-flex object-cover">
        <div class="p-4">
          <h3 class="font-semibold text-lg">Captain Tsubasa</h3>
          <p class="text-sm text-gray-600">by Mas Raka</p>
        </div>
      </div>


    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-white border-t mt-10 py-4 text-center text-sm text-gray-600">
    © 2025 Pcg App
  </footer>

</body>
</html>