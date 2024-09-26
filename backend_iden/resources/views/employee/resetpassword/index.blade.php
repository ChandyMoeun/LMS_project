<x-app-layout>
    <main class="mt-10 p-10">
        <div class="d-flex border-b-2 px-8 border-gray-300 h-15 mb-16 items-center">
            <a href="/admin/mail">
                <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
            </a>
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-400 w-5/12"><b>Reset Password for Employees</b></h1>
        </div>
        @if ($employees->isEmpty())
        <p>No employees found.</p>
        @else
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-black text-white">
                <tr>
                    <th class="py-3 px-5 text-left text-sm font-medium border-b">ID</th>
                    <th class="py-3 px-5 text-center text-sm font-medium border-b">Name</th>
                    <th class="py-3 px-5 text-center text-sm font-medium border-b">Email</th>
                    <th class="py-3 px-5 text-center w-3/12 text-sm font-medium border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-5 text-sm text-gray-600 border-b">{{ $employee->staff_id }}</td>
                    <td class="py-3 px-5 text-sm text-center border-b">{{ $employee->full_name }}</td>
                    <td class="py-3 px-5 text-sm text-center text-gray-600 border-b">{{ $employee->email }}</td>
                    <td class="py-3 px-5 text-center text-sm text-gray-600 border-b">
                        <a href="{{ route('admin.employee.resetpassword.form', ['id' => $employee->id]) }}" class="inline-block bg-black text-white font-bold py-2 px-4 rounded-md hover:bg-yellow-400 transition duration-300">
                            Reset Password
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </main>
</x-app-layout>