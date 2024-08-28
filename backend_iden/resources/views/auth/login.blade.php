<x-guest-layout>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex w-3/4">
      <!-- Left section with image -->
      <div class=" flex d-flex flex-col items-center justify-center bg-white-200">
        <img src="/images/login.jpg" alt="Login Illustration" class="object-cover">
          <div class="flex justify-end mb-4 " >
            <p class=" text-sm">Sign in here to join iDen leave management system.</p>
          </div>
      </div>
      <!-- Right section with form -->
      <div class="w-1/2 p-10 flex flex-col justify-center">
        <h1 class="font-bold text-2xl mb-6 text-center"><B>SIGN IN</B></h1>
        <form method="POST" action="{{ route('admin.login') }}" >
          @csrf
          <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border border-gray-300 rounded w-full py-2 px-3 mt-2 focus:outline-none focus:border-blue-400" placeholder="Enter your email" required autofocus>
          </div>
          <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="border border-gray-300 rounded w-full py-2 px-3 mt-2 focus:outline-none focus:border-blue-400" placeholder="Enter your password" required autocomplete="current-password">
          </div>
          <div class="flex justify-end items-center mb-4">
            <a href="#" class="text-blue-500 text-sm">Forget password?</a>
          </div>
          <button type="submit" class="w-5px mt-5 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors">Sign in</button>
        </form> 
      </div>
    </div>
  </div>
</x-guest-layout>