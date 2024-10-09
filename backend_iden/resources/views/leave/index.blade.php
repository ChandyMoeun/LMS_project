<x-app-layout>
    <div class="mt-20">
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <!-- Admin Requites leave -->
            <div class="d-flex border-b-2 border-gray-300 h-20 pl-20 items-center mb-2">
                <h1 class="font-bold text-3xl mt-5 w-1/3 hover:text-yellow-400"><b>Admin leave</b></h1>
            </div>

            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-end mb-4">
                    @can('Leave create')
                    <a href="{{ route('admin.leave.create') }}" class="bg-black text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-yellow-400 transition-colors">Request Leave</a>
                    @endcan
                </div>

                <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-black">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs text-white uppercase tracking-wider">Staff ID</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">Name</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">Type</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">From</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">To</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">Half Day</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">files</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">Status</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">Total</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">Detail</th>
                                <th class="py-3 px-6 text-center text-xs text-white uppercase tracking-wider">Approver</th>
                                <th class="py-3 px-6 w-1/12 text-center text-xs text-white uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @can('Leave access')
                            @foreach($leaveRequests as $leaveRequest)
                            <tr class="hover:bg-gray-50">
                                <td class="py-4 px-6 text-sm text-center text-black">{{ $leaveRequest->employee->staff_id ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-sm text-center text-black">{{ $leaveRequest->employee->full_name ?? 'N/A' }}</td>
                                <td class="py-4 text-center px-6 text-sm text-black">{{ $leaveRequest->leaveType->leave_name ?? 'N/A' }}</td>
                                <td class="py-4 px-6 text-sm text-center text-black">{{ \Carbon\Carbon::parse($leaveRequest->from_date)->format('Y-m-d') }} </td>
                                <td class="py-4 px-6 text-sm text-center text-black">{{ $leaveRequest->to_date ? \Carbon\Carbon::parse($leaveRequest->to_date)->format('Y-m-d') : '-' }}</td>
                                <td class="py-4 px-6 text-sm text-center text-black">
                                    {{ $leaveRequest->half_day_type ? ucfirst($leaveRequest->half_day_type) : ($leaveRequest->start_time && $leaveRequest->end_time ? \Carbon\Carbon::parse($leaveRequest->start_time)->format('H:i') . ' - ' . \Carbon\Carbon::parse($leaveRequest->end_time)->format('H:i')  : '-') }}
                                </td>
                                <!-- Display attachment -->
                                @php
                                // Initialize $attachments to an empty array
                                $attachments = [];
                                if ($leaveRequest->attachment) {
                                // Decode the JSON or explode the comma-separated string into an array
                                $attachments = json_decode($leaveRequest->attachment, true);
                                }
                                @endphp

                                <td class="py-4 px-6 text-sm text-center text-black">
                                    <!-- Display the first attachment if it exists -->
                                    @if(isset($attachments[0]))
                                    @php
                                    // Get the full path of the first file
                                    $firstFilePath = asset('storage/' . $attachments[0]);
                                    // Get the file extension for the first file
                                    $firstExtension = pathinfo($attachments[0], PATHINFO_EXTENSION);
                                    @endphp
                                    <!-- Check if the first file is an image -->
                                    @if(in_array($firstExtension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                    <!-- Image Thumbnail (Clickable) -->
                                    <img src="{{ $firstFilePath }}" alt="Attachment Preview" class="max-h-5 max-w-full object-cover mb-2 cursor-pointer" id="first-image" onclick="showFullScreenImage('{{ $firstFilePath }}')">
                                    @else
                                    <a href="{{ $firstFilePath }}" class="text-blue-600" target="_blank">{{ basename($attachments[0]) }}</a>
                                    @endif

                                    <!-- Fullscreen Image Modal -->
                                    <div id="imageModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center">
                                        <span class="absolute top-4 right-4 text-white text-3xl cursor-pointer" onclick="closeImageModal()">&times;</span>
                                        <img id="modalImage" class="max-w-full max-h-screen object-contain">
                                    </div>

                                    @endif
                                    <!-- Show more button -->
                                    @if(count($attachments) > 1)
                                    <button class="show-more-btn mt-2 text-blue-600 hover:underline" data-modal-id="attachmentModal-{{ $leaveRequest->id }}">See More</button>
                                    @endif
                                </td>
                                <!-- Modal for showing all attachments -->
                                @if(count($attachments) > 0)
                                <div id="attachmentModal-{{ $leaveRequest->id }}" class="fixed inset-0 flex items-center justify-center hidden z-50">
                                    <!-- Modal Overlay and Content for Attachments -->
                                    <div class="modal-overlay fixed inset-0 bg-gray-600 bg-opacity-50"></div>
                                    <div class="modal-content bg-white p-2 rounded shadow-lg max-w-lg mx-auto max-h-[80vh] overflow-auto fixed inset-0 mt-20 mb-20">
                                        <h2 class="text-lg font-semibold mb-4">Attachments for Leave Request {{ $leaveRequest->id }}</h2>
                                        <div id="modal-attachments-{{ $leaveRequest->id }}">
                                            @foreach($attachments as $attachment)
                                            @php
                                            $filePath = asset('storage/' . $attachment);
                                            $extension = pathinfo($attachment, PATHINFO_EXTENSION);
                                            @endphp

                                            @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                            <!-- Image that can be clicked for full screen -->
                                            <img src="{{ $filePath }}" alt="Attachment Preview" class="max-h-40 max-w-full object-cover mb-2 cursor-pointer preview-image-{{ $leaveRequest->id }}">
                                            @else
                                            <!-- Download link for non-image attachments -->
                                            <a href="{{ $filePath }}" class="text-blue-600" target="_blank">{{ basename($attachment) }}</a>
                                            @endif
                                            @endforeach
                                        </div>
                                        <button class="close-modal-btn mt-4 px-4 py-2 bg-blue-600 text-white rounded">Close</button>
                                    </div>

                                    <!-- Full-screen Image Modal -->
                                    <div id="fullscreen-modal-{{ $leaveRequest->id }}" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center">
                                        <img id="fullscreen-image-{{ $leaveRequest->id }}" src="" class="max-w-full max-h-full object-contain">
                                        <button id="close-fullscreen-{{ $leaveRequest->id }}" class="absolute top-4 right-4 px-4 py-2 bg-white text-black rounded">Close</button>
                                    </div>

                                    <!-- JavaScript to handle full-screen image viewing -->
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const previewImages = document.querySelectorAll('.preview-image-{{ $leaveRequest->id }}');
                                            const fullscreenModal = document.getElementById('fullscreen-modal-{{ $leaveRequest->id }}');
                                            const fullscreenImage = document.getElementById('fullscreen-image-{{ $leaveRequest->id }}');
                                            const closeFullscreenBtn = document.getElementById('close-fullscreen-{{ $leaveRequest->id }}');

                                            // Add click event to all preview images
                                            previewImages.forEach(image => {
                                                image.addEventListener('click', function() {
                                                    fullscreenImage.src = this.src; // Set the full-screen image source
                                                    fullscreenModal.classList.remove('hidden'); // Show full-screen modal
                                                });
                                            });

                                            // Close full-screen modal when clicking close button
                                            closeFullscreenBtn.addEventListener('click', function() {
                                                fullscreenModal.classList.add('hidden');
                                            });

                                            // Close full-screen modal when clicking anywhere outside the image
                                            fullscreenModal.addEventListener('click', function(event) {
                                                if (event.target === fullscreenModal) {
                                                    fullscreenModal.classList.add('hidden');
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                                @endif
                                <!-- Actions column -->
                                <td class="py-4 px-6 text-sm">
                                    @if($leaveRequest->status == 'pending')
                                    <span class="bg-yellow-400 text-center text-white px-2 py-1 rounded-full text-xs font-semibold">Pending</span>
                                    @elseif($leaveRequest->status == 'approved')
                                    <span class="bg-green-400 text-center text-white px-2 py-1 rounded-full text-xs font-semibold">Approved</span>
                                    @else
                                    <span class="bg-red-400 text-center text-white px-2 py-1 rounded-full text-xs font-semibold">Rejected</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-sm text-center text-black">{{ $leaveRequest->total_requested_days }}</td>

                                <td class="py-4 px-6 text-sm text-center">
                                    <a href="{{ route('admin.leave.show', $leaveRequest->id) }}" class="text-blue-700 hover:text-blue-300 ">
                                        View
                                    </a>
                                </td>

                                <td class="py-4 px-6 text-sm text-gray-500">
                                    @if($leaveRequest->status === 'approved')
                                    {{ $leaveRequest->approver->full_name ?? 'no name' }}
                                    @elseif($leaveRequest->status === 'rejected')
                                    {{ $leaveRequest->rejector->full_name ?? 'no name'}}
                                    @else
                                    Pending
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-right">
                                    <!-- View button to toggle the visibility -->
                                    <button type="button" class="text-blue-700 hover:text-blue-300 font-semibold" onclick="toggleButtons({{ $leaveRequest->id }})">
                                        View Options
                                    </button>
                                    <!-- Hidden buttons (Edit, Approve, Reject) -->
                                    <div id="action-buttons-{{ $leaveRequest->id }}" class=" flex justify-center mt-2 m-2 flex space-x-2">
                                        @can('Leave edit')
                                        <form action="{{ route('admin.leave.approve', $leaveRequest) }}" method="POST" class="inline" onsubmit="disableButtons({{ $leaveRequest->id }})">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="bg-blue-500 text-white px-2 py-2 rounded-md shadow-md hover:bg-blue-600 transition-all duration-300 ease-in-out font-semibold">
                                                Approve
                                            </button>
                                        </form>
                                        @endcan

                                        @can('Leave edit')
                                        <form action="{{ route('admin.leave.reject', $leaveRequest) }}" method="POST" class="inline" onsubmit="disableButtons({{ $leaveRequest->id }})">
                                            @csrf
                                            @method('post')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-2 rounded-md shadow-md hover:bg-red-600 transition-all duration-300 ease-in-out font-semibold">
                                                Reject
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                                @endforeach
                                @endcan
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination links -->
                <div class="mt-4">
                    {{ $leaveRequests->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<script>
    function toggleButtons(leaveRequestId) {
        var buttons = document.getElementById('action-buttons-' + leaveRequestId);
        buttons.classList.toggle('hidden'); // Toggle 'hidden' class to show/hide the buttons
    }

    function disableButtons(leaveRequestId) {
        var buttons = document.getElementById('action-buttons-' + leaveRequestId);
        buttons.classList.add('hidden'); // Hide the buttons after form is submitted

        // Disable the buttons within the forms to prevent further clicks
        var forms = buttons.querySelectorAll('form');
        forms.forEach(function(form) {
            var submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true; // Disable the button
            submitButton.classList.add('opacity-50', 'cursor-not-allowed'); // Add visual feedback
        });
    };

    // Show the modal when any "Show More" button is clicked
    document.querySelectorAll('.show-more-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden'); // Show the modal
        });
    });

    // Hide the modal when any "Close" button is clicked
    document.querySelectorAll('.close-modal-btn').forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal-content').parentElement; // Get the modal
            modal.classList.add('hidden'); // Hide the modal
        });
    });

    // Optional: Close the modal when clicking on the overlay
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function() {
            const modal = this.parentElement; // Get the modal
            modal.classList.add('hidden'); // Hide the modal
        });
    });

    // Function to show the fullscreen image modal
    function showFullScreenImage(imageSrc) {
        var modal = document.getElementById('imageModal');
        var modalImage = document.getElementById('modalImage');

        // Set the image source to the clicked image's source
        modalImage.src = imageSrc;

        // Display the modal by removing the 'hidden' class
        modal.classList.remove('hidden');
    }

    // Function to close the image modal
    function closeImageModal() {
        var modal = document.getElementById('imageModal');

        // Hide the modal by adding the 'hidden' class
        modal.classList.add('hidden');
    }
</script>