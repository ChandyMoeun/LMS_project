<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mt-20">
        <div class="container mx-auto px-6 py-2">
            <div class="text-right">
                @can('Position create')
                <a href="{{ route('admin.position.create') }}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-600 transition-colors">New Position</a>
                @endcan
            </div>

            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200">Position Name</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200">Department Name</th>
                            <th class="py-4 px-6 bg-gray-100 font-bold text-sm text-gray-700 border-b border-gray-200 text-right w-2/12">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('Position access')
                        @foreach($positions as $position)
                        <tr class="hover:bg-gray-100">
                            <td class="py-4 px-6 border-b border-gray-200">{{ $position->name }}</td>
                            <td class="py-4 px-6 border-b border-gray-200">  {{ $position->department ? $position->department->name : 'No Department' }}</td>

                            
                            <td class="py-4 px-6 border-b border-gray-200 text-right">
                                @can('Position edit')
                                <a href="{{ route('admin.position.edit', $position->id) }}" class="text-gray-600 font-bold py-1 px-3 rounded text-xs bg-green-500 hover:bg-green-600 text-white">Edit</a>
                                @endcan

                                @can('Position delete')
                                <form action="{{ route('admin.position.destroy', $position->id) }}" method="POST" class="inline">
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

                @can('Position access')
                <div class="text-right p-4 py-10">
                    {{ $positions->links() }}
                </div>
                @endcan
            </div>

        </div>
    </main>
</x-app-layout>