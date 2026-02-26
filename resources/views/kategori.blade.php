<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kategori Buku</title>
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
      <h1 class="text-lg font-semibold">Library App</h1>
      <ul class="flex gap-4 text-sm text-gray-700">
        <li><a href="home" class="hover:text-blue-600">Home</a></li>
        <li><a href="buku" class="hover:text-blue-600">Books</a></li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-6 py-10">
    <h2 class="text-2xl font-bold mb-6">Kategori Buku</h2>

    <!-- Grid Kategori -->
    <div class="mt-20 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

      <!-- Card kategori -->
      <div class="bg-white rounded-lg shadow hover:shadow-md transition p-6 flex items-center justify-center text-center">
        <img src="https://i.pinimg.com/736x/99/df/f6/99dff6649f7e000660624645ea563826.jpg">
     

      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition p-6 flex items-center justify-center text-center">
        <img src="https://img.freepik.com/premium-vector/nusantara-editable-text-effect_693064-127.jpg?w=2000">
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition p-6 flex items-center justify-center text-center">
        <img src="data:image/png;base64,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">
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition p-6 flex items-center justify-center text-center">
        <img src="https://i.pinimg.com/1200x/9d/19/c0/9d19c025277feb0e7050ed72cdfe4713.jpg">
      </div>

      <div class="bg-white rounded-lg shadow hover:shadow-md transition p-6 flex items-center justify-center text-center">
        <img src="https://i.pinimg.com/736x/b4/b8/c6/b4b8c62594837187b3a4907731a8f9ae.jpg">
      </div>

    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-white border-t mb-0 mt-20 py-4 text-center text-sm text-gray-600">
    © 2025 Library App
  </footer>

</body>
</html>
