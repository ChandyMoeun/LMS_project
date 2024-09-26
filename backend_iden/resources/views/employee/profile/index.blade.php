<x-app-layout>
    <main class="mt-10 p-5">

        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <div class="container">
            <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center mb-10">
                <a href="{{ route('admin.employee.index') }}">
                    <svg class="w-6 h-6 mb-10 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
                <h1 class="font-bold text-3xl w-3/12 mt-5 hover:text-yellow-400"><b>Employee Profile </b></h1>
            </div>
            <div class="container mx-auto p-6">
                <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
                    <div class="d-flex justify-content-center pt-5">
                        @if($employee->profile)
                        <img src="{{ asset('images/' . $employee->profile) }}" alt="Profile Picture" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                        <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="d-flex justify-around gap-4 p-6 mt-3">
                        <!-- Left column -->
                        <div>
                            <p><strong>Staff ID:</strong> {{$employee->staff_id ?? '?'}}</p>
                            <p><strong>Name:</strong> {{$employee->full_name}}</p>
                            <p><strong>Gender:</strong> {{$employee->gender}}</p>
                            <p><strong>Date of Birth:</strong> {{$employee->dob}}</p>
                            <p><strong>Position:</strong> {{$employee->position->name}}</p>
                            <p><strong>Department:</strong> {{$employee->department->name}}</p>
                        </div>

                        <!-- Right column -->
                        <div>
                            <p><strong>Date join:</strong> {{$employee->joined_date}}</p>
                            <p><strong>Confirm Date:</strong> {{$employee->entitled_date}}</p>
                            <p><strong>Phone:</strong> 015637286</p>
                            <p><strong>Telegram Number:</strong> 015637286</p>
                            <p><strong>Email:</strong> {{$employee->email}}</p>
                            <p><strong>Line Manager:</strong> {{$employee->manager->full_name ?? 'No manager'}}</p>
                            <p><strong>Subline:</strong> XXX</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>