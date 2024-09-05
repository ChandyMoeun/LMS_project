<x-app-layout>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="container mt-20" style="padding: 5%;">
        {{ $employee}}
        <a href="/admin/employee">
            <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
            </svg>
        </a>
        <div class="flex border-b-2 border-gray-300 h-20 items-center mb-10">
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-500"><b>Employee Profile </b></h1>
        </div>

        <div class="container mx-auto p-6">
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-center p-6 bg-yellow-200">
                    <img src="{{ asset('path-to-image.jpg') }}" alt="Profile Image" class="w-32 h-32 bg-green-200">
                </div>
                <div class="d-flex justify-around gap-4 p-6 mt-3">
                    <!-- Left column -->
                    <div>
                        <p><strong>Staff ID:</strong> 001</p>
                        <p><strong>Name:</strong> Kris Wang</p>
                        <p><strong>Gender:</strong> Female</p>
                        <p><strong>Date of Birth:</strong> 04.28.2024</p>
                        <p><strong>Position:</strong> Front-End Developer</p>
                        <p><strong>Department:</strong> Web Development</p>
                        <p><strong>Date entitle:</strong> date that you can take leave</p>
                    </div>

                    <!-- Right column -->
                    <div>
                        <p><strong>Date join:</strong>12.08.2024</p>
                        <p><strong>Phone:</strong> 015637286</p>
                        <p><strong>Telegram Number:</strong> 015637286</p>
                        <p><strong>Email:</strong> kriswang@gmail.com</p>
                        <p><strong>Line Manager:</strong> Mr. Cat</p>
                        <p><strong>Subline:</strong> Mr. Cat</p>
                    </div>
                </div>

                <div class="flex justify-center p-4">
                    <button type="submit" class="w-5px mt-5 bg-red-500 text-red font-bold py-2 px-4 hover:bg-red-400 focus:outline-none focus:bg-red-700 transition-colors" style=" border-radius: 5px"><a href="/admin/employee" style="text-decoration: none; color: white;">Back</a></button>
                    <button type="submit" class="w-5px mt-5 bg-blue-500 text-white font-bold py-2 px-4 hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors" style=" border-radius: 5px"><a href="/admin/employee/{id}/edit" style="text-decoration: none; color: white;">Edit</a></button>
                </div>
            </div>
        </div>

</x-app-layout>