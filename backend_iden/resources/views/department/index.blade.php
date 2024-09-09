<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mt-20">
        <div class="container mx-auto px-6 py-2">
            <div class="text-right">
                @can('Department create')
                <a href="{{ route('admin.department.create') }}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">Add New</a>
                @endcan
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