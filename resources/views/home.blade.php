@extends('layouts.app')

@section('content')
<!-- Custom Navigation for Home Page -->
<nav class="bg-white shadow p-4 mb-8">
    <div class="container mx-auto flex justify-between">
        <a href="/" class="font-bold">Toko Thrift</a>
        <div>
            <a href="/" class="mr-4">Home</a>
            <a href="/clothes" class="mr-4">Shop</a>
            <a href="/about" class="mr-4">About</a>     
            <a href="/cart" class="mr-4">Cart</a>
            <a href="/orders">Orders</a>
        </div>
    </div>
</nav>

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-md p-8" id="about">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Tentang Toko Thrift</h1>

        <div class="prose prose-lg max-w-none">
            <p class="text-gray-700 leading-relaxed mb-6">
                Toko Thrift kami adalah platform belanja online yang menyediakan berbagai pilihan pakaian bekas berkualitas dengan harga terjangkau. Kami percaya bahwa fashion tidak harus mahal untuk tetap tampil keren, unik, dan percaya diri. Melalui konsep thrift, kami menghadirkan gaya yang lebih ramah lingkungan sekaligus mendukung gaya hidup berkelanjutan.
            </p>

            <p class="text-gray-700 leading-relaxed mb-6">
                Kami menyediakan berbagai kategori seperti kaos, kemeja, jaket, hoodie, celana, dan aksesoris dari berbagai merek dan gaya. Setiap produk yang kami jual telah melalui proses seleksi dan pengecekan kualitas sehingga tetap nyaman dipakai dan layak jual. Kami ingin memastikan pelanggan mendapatkan barang terbaik meskipun berasal dari preloved.
            </p>

            <p class="text-gray-700 leading-relaxed mb-6">
                Selain membantu kamu berhemat, berbelanja di toko thrift kami juga berarti ikut mengurangi limbah fashion. Dengan menggunakan kembali pakaian yang masih layak pakai, kita bersama-sama ikut menjaga lingkungan dan mengurangi dampak buruk industri fast fashion.
            </p>

            <p class="text-gray-700 leading-relaxed mb-6">
                Website ini dibuat agar pelanggan bisa dengan mudah melihat katalog produk, memilih ukuran dan model, serta melakukan pemesanan secara cepat dan aman. Kami terus berusaha memberikan pelayanan terbaik, update produk terbaru, dan pengalaman belanja yang menyenangkan.
            </p>

            <p class="text-gray-700 leading-relaxed mb-4">
                Terima kasih telah mendukung toko thrift kami. Semoga kamu menemukan gaya favoritmu di sini!
            </p>

            <div class="text-center text-2xl mt-8">
                ♻️👕
            </div>
        </div>
    </div>
</div>
@endsection
