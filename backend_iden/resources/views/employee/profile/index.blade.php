<x-app-layout>
    <main class="mt-10 p-7">
            <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center mb-5">
                <a href="/admin/employee">
                    <svg class="mb-5 w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
                <h1 class="font-bold mr-20 text-3xl mt-3 hover:text-yellow-400"><b>Employee Profile </b></h1>
            </div>
            <div class="container p-6">
                <div class="d-flex justify-center mx-auto bg-white rounded-lg shadow-md px-5 w-11/12">
                    <div class="flex items-center justify-center p-6">
                        <img src="{{ asset('path-to-image.jpg') }}" alt="Profile Image" class="w-32 h-32 bg-gray-200">
                    </div>
                    <div class="flex justify-around gap-6 mt-5">
                        <!-- Left column -->
                        <div class="flex flex-col gap-4">
                            <p><strong>Staff ID:</strong> 001</p>
                            <p><strong>Name:</strong> Kris Wang</p>
                            <p><strong>Gender:</strong> Female</p>
                            <p><strong>Date of Birth:</strong> 04.28.2024</p>
                            <p><strong>Position:</strong> Front-End Developer</p>
                            <p><strong>Department:</strong> Web Development</p>
                        </div>

                        <!-- Right column -->
                        <div class="flex flex-col gap-4">
                        <p><strong>Date join:</strong> 12.08.2024</p>
                            <p><strong>Comfirm Date:</strong> date that you can take leave</p>
                            <p><strong>Phone:</strong> 015637286</p>
                            <p><strong>Telegram Number:</strong> 015637286</p>
                            <p><strong>Email:</strong> kriswang@gmail.com</p>
                        </div>
                    </div>

                    <div class="flex justify-center gap-4 p-4">
                        <button type="submit" class="w-5px mt-5 bg-red-500 text-red font-bold py-2 px-4 hover:bg-red-400 focus:outline-none focus:bg-red-700 transition-colors" style=" border-radius: 5px"><a href="/admin/employee" style="text-decoration: none; color: white;">Back</a></button>
                        <button type="submit" class="w-5px mt-5 bg-black text-white font-bold py-2 px-4 hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors" style=" border-radius: 5px">@can('Employee edit')
                            <a href="{{route('admin.employee.edit',$employee->id)}}" style="text-decoration: none; color: white;">Edit</a></button>@endcan
                    </div>
                </div>
            </div>
    </main>
</x-app-layout>