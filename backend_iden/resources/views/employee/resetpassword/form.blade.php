<x-app-layout>
    <main class="mt-10 p-12">
        <h1 class="text-2xl font-bold mb-4">Reset Password for {{ $employee->full_name }}</h1>

        <!-- Display success message -->
        @if(session('success'))
        <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Reset password form -->
        <form action="{{ route('admin.employee.resetpassword.update', ['id' => $employee->id]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="password" class="block text-sm font-bold mb-2">New Password</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                <!-- Error message for password -->
                <div id="password-error" class="hidden text-red-700 rounded relative mb-4"></div>
            </div>
            
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                <!-- Error message for password confirmation -->
                <div id="confirmation-error" class="hidden text-red-700 rounded relative mb-4"></div>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Reset Password
            </button>
        </form>
    </main>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('password-error');
        const confirmationInput = document.getElementById('password_confirmation');
        const confirmationError = document.getElementById('confirmation-error');

        // Validate new password
        passwordInput.addEventListener('input', function() {
            if (passwordInput.value.length < 8) {
                passwordError.textContent = 'The password must be at least 8 characters.';
                passwordError.classList.remove('hidden');
            } else {
                passwordError.classList.add('hidden');
            }
        });

        // Validate password confirmation
        confirmationInput.addEventListener('input', function() {
            if (confirmationInput.value !== passwordInput.value) {
                confirmationError.textContent = 'The password confirmation does not match.';
                confirmationError.classList.remove('hidden');
            } else {
                confirmationError.classList.add('hidden');
            }
        });

        // Hide success alert after 5 seconds
        const successAlert = document.getElementById('alert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 2000);
        }
    });
</script>