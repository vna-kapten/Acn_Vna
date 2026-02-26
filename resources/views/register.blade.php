<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Pcg App</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>

    <form id="registerForm" class="space-y-4">
      <!-- Name -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" id="name" name="name" required
          class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200 focus:border-blue-400" 
          placeholder="Enter your full name">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" required
          class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200 focus:border-blue-400" 
          placeholder="Enter your email">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required minlength="6"
          class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200 focus:border-blue-400" 
          placeholder="Enter your password">
      </div>

      <!-- Confirm Password -->
      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required
          class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-blue-200 focus:border-blue-400" 
          placeholder="Confirm your password">
      </div>

      <!-- Button -->
      <button type="submit" 
        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
        Register
      </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
      Already have an account? 
      <a href="/login" class="text-blue-600 hover:underline">Login</a>
    </p>
  </div>

  <script>
    document.getElementById('registerForm').addEventListener('submit', function (e) {
      e.preventDefault(); // Prevent form from reloading page

      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('password_confirmation').value;

      if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
      }

      // Simulasi kirim data
      console.log("Registration Data:");
      console.log({ name, email, password });

      // Simulasi sukses
      alert("Registration successful!");
      // Optionally, redirect to login
       window.location.href = '/login';
    });
  </script>

</body>
</html>