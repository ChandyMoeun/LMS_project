<!-- Favicon -->
<link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/x-icon">

<!-- <title> {{ config('app.name'),'iDEN' }}</title> -->
<title>iDEN_LMS</title>

<x-guest-layout>
  <div class="min-h-screen flex items-center justify-center" style="background-color: #ECECEC;">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex bg-gray-#F9F9F9">
      <!-- Left section with image -->
      <div class=" flex d-flex flex-col justify-center" style="width: 50%; ">
        <img src="/images/login.png" alt="Login Illustration" class="object-cover">
        <p class=" flex mb-5 justify-center text-sm" style="color: #B7B7B7;">Sign in here to join iDEN leave management system.</p>
      </div>
      <!-- Right section with form -->
      <div class="w-1/2 p-3 flex flex-col justify-center bg-gray-#F9F9F9">
        <h1 class="font-bold text-4xl mr-5 mb-6 text-center"><B>SIGN IN</B></h1>
        <form method="POST" action="{{ route('admin.login') }}">
          @csrf
          <div class="mb-4 mr-3">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="border border-gray-300 rounded w-full py-2 px-3 mt-2 focus:outline-none focus:border-blue-400" placeholder="Enter your email" required autofocus>
          </div>
          <div class="mb-4 mr-3">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="border border-gray-300 rounded w-full py-2 px-3 mt-2 focus:outline-none focus:border-blue-400" placeholder="Enter your password" required autocomplete="current-password">
          </div>
          <div class="flex justify-end items-center mb-4 mr-7">
            <a href="/forgot-password" class="text-blue-500 text-sm">Forget password?</a>
          </div>
          <button type="submit" class="w-5px mt-5 bg-blue-500 text-white font-bold py-2 px-4 hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors" style=" border-radius: 5px">Sign in</button>
        </form>
      </div>
    </div>
  </div>
</x-guest-layout>