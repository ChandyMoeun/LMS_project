<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mt-10 p-10">
        <div class="container mx-auto px-6 py-2">
            <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center mb-5">
                <a href="/admin/mail">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                </a>
                <h1 class="font-bold text-3xl mt-5 hover:text-yellow-400 w-1/4"><b>Departments </b></h1>
            </div>
            <div class="flex items-center justify-between mt-20 px-9">
                <div class="relative mx-4 lg:mx-0">
                    <a class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </a>

                    <input class="form-input w-32 h-9 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
                        placeholder="Search department name...">
                </div>
                <div class="text-right">
                    @can('Department create')
                    <a href="{{ route('admin.department.create') }}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">New Department</a>
                    @endcan
                </div>
            </div>

            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200">Department Name</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200 text-right w-2/12">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('Department access')
                        @foreach($departments as $department)
                        <tr class="hover:bg-gray-100">
                            <td class="py-4 px-6 border-b border-gray-200">{{ $department->name }}</td>
                            <td class="py-4 px-6 border-b border-gray-200 text-right">
                                @can('Department view')
                                <a href="{{ url('admin/detail/' . $department->id) }}" class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-blue-500 hover:bg-blue-600 text-white">View</a>
                                @endcan

                                @can('Department edit')
                                <a href="{{ route('admin.department.edit', $department->id) }}" class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-green-500 hover:bg-green-600 text-white">Edit</a>
                                @endcan

                                @can('Department delete')
                                <form action="{{ route('admin.department.destroy', $department->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-600 text-white">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        @endcan
                    </tbody>
                </table>

                @can('Department access')
                <div class="text-right p-4 py-10">
                    {{ $departments->links() }}
                </div>
                @endcan
            </div>

        </div>
    </main>
</x-app-layout>