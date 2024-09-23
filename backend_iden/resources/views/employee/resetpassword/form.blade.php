<x-app-layout>
    <main class="mt-10 p-12">
        <div class="d-flex border-b-2 border-gray-300 h-15 mb-16 items-center">
            <a href="/admin/employee/resetpassword/index">
                <svg class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
            </a>
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-4/12"><b>Reset Password for {{ $employee->full_name }}</b></h1>
        </div>

        <!-- Display success message -->
        @if(session('success'))
        <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Display validation errors -->
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Reset password form -->
        <form action="{{ route('admin.employee.resetpassword.update', ['id' => $employee->id]) }}" method="POST" class="bg-white p-5 shadow-md rounded-lg overflow-hidden">
            @csrf
            <div class="mb-4">
                <label for="password" class="block text-sm font-bold mb-2">New Password</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror" required>
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password_confirmation') border-red-500 @enderror" required>
                @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-yellow-400 hover:bg-black text-white font-bold py-2 px-4 rounded">
                    Reset Now
                </button>
            </div>
        </form>
    </main>
</x-app-layout>

<!-- Client-side validation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const confirmationInput = document.getElementById('password_confirmation');

        // Validate new password on input
        passwordInput.addEventListener('input', function() {
            if (passwordInput.value.length < 8) {
                passwordInput.setCustomValidity('Password must be at least 8 characters long.');
            } else {
                passwordInput.setCustomValidity('');
            }
        });

        // Validate password confirmation on input
        confirmationInput.addEventListener('input', function() {
            if (confirmationInput.value !== passwordInput.value) {
                confirmationInput.setCustomValidity('Password confirmation does not match.');
            } else {
                confirmationInput.setCustomValidity('');
            }
        });

        // Hide success alert after 5 seconds
        const successAlert = document.getElementById('alert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 4000);
        }
    });
</script>