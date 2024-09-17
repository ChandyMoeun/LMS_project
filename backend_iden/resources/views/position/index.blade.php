<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 mt-20 p-5">
        <div class="d-flex border-b-2 border-gray-300 px-8 h-20 items-center ml-7 mr-7">
            <a href="/admin/mail">
                <svg class="w-6 h-4 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
            </a>
            <h1 class="font-bold text-3xl mt-5 hover:text-yellow-400 w-1/4"><b>Position</b></h1>
        </div>
        <div class="container mx-auto px-6 py-2 mt-3">
            <div class="text-right">
                @can('Position create')
                <a href="{{ route('admin.position.create') }}" class="bg-black text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-yellow-400 transition-colors">New Position</a>
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
                            <td class="py-4 px-6 border-b border-gray-200"> {{ $position->department ? $position->department->name : 'No Department' }}</td>


                            <td class="py-4 px-6 border-b border-gray-200 text-right">
                                @can('Position edit')
                                <a href="{{ route('admin.position.edit', $position->id) }}" class="font-bold py-1 px-3 rounded text-xs bg-black hover:bg-yellow-400 text-white">Edit</a>
                                @endcan

                                @can('Position delete')
                                <form action="{{ route('admin.position.destroy', $position->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="font-bold py-1 px-3 rounded text-xs bg-red-500 hover:bg-red-400 text-white">Delete</button>
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