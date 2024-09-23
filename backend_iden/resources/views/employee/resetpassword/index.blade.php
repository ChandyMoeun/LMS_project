<x-app-layout>
    <main class="mt-10 p-12">
        <h1 class="text-2xl font-bold mb-4">Reset Password for Employees</h1>
        @if ($employees->isEmpty())
        <p>No employees found.</p>
        @else
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-5 text-left text-sm font-medium text-gray-700 border-b">ID</th>
                    <th class="py-3 px-5 text-left text-sm font-medium text-gray-700 border-b">Name</th>
                    <th class="py-3 px-5 text-left text-sm font-medium text-gray-700 border-b">Email</th>
                    <th class="py-3 px-5 text-left text-sm font-medium text-gray-700 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-5 text-sm text-gray-600 border-b">{{ $employee->staff_id }}</td>
                    <td class="py-3 px-5 text-sm text-gray-600 border-b">{{ $employee->full_name }}</td>
                    <td class="py-3 px-5 text-sm text-gray-600 border-b">{{ $employee->email }}</td>
                    <td class="py-3 px-5 text-sm text-gray-600 border-b">
                        <a href="{{ route('admin.employee.resetpassword.form', ['id' => $employee->id]) }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
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