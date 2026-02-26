<x-admin.layout title="Dashboard">
  <div class="bg--600 text-white p-4 rounded mb-6">
    <h1 class="text-xl font-semibold">Welcome, Admin</h1>
    <p class="text-sm">Overview of the system.</p>
  </div>

  <div class="bg-white p-4 rounded shadow mb-6">
    <h2 class="text-lg font-semibold text-black mb-2">Dashboard</h2>
    <p class="text-sm text-black">This is the admin dashboard content.</p>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="px-4 py-5 rounded bg-white border border-gray-200">
      <p class="font-medium text-sm text-gray-950">Total Books</p>
      <hr class="w-full bg-gray-200 my-2">
      <p class="font-semibold text-xl text-gray-950">10</p>
    </div>
    <div class="px-4 py-5 rounded bg-white border border-gray-200">
      <p class="font-medium text-sm text-gray-950">Total Users</p>
      <hr class="w-full bg-gray-200 my-2">
      <p class="font-semibold text-xl text-gray-950">10</p>
    </div>
  </div>

  @push('scripts')
    <script>
      console.log('Halaman Dashboard Admin siap!');
    </script>
  @endpush
</x-admin.layout>

