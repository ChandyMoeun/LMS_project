<x-app-layout>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="container mt-10 p-5">
        <a href="{{ route('admin.dashboard') }}">
            <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
            </svg>
        </a>
        <div class="flex border-b-2 border-gray-300 items-center mb-16">
            <h1 class="font-bold text-3xl mt-3 hover:text-yellow-500"><b>Leave Request Details</b></h1>
        </div>
        <div class="card shadow-sm mx-auto px-4 py-6 bg-white text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    @if($leaveRequest->employee->profile)
                    <img src="{{ asset('images/' . $leaveRequest->employee->profile) }}" alt="Profile Picture" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                    <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    @endif
                </div>
                <h3 class="p-4 d-flex justify-content-center text-warning"><b> User Information</b></h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label for="userId" class="form-label">User ID</label>
                        <input type="text" id="userId" class="form-control" value="{{ $leaveRequest->employee->staff_id }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" id="fullName" class="form-control" value="{{ $leaveRequest->employee->full_name ?? 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" id="gender" class="form-control" value="{{ $leaveRequest->employee->gender ?? 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" id="department" class="form-control" value="{{ $leaveRequest->employee->department->name ?? 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" id="position" class="form-control" value="{{ $leaveRequest->employee->position->name ?? 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="leaveDates" class="form-label">From | To</label>
                        <input type="text" id="leaveDates" class="form-control" value="{{ $leaveRequest->from_date}} | {{ $leaveRequest->to_date ? $leaveRequest->to_date : 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="leaveType" class="form-label">Leave Type</label>
                        <input type="text" id="leaveType" class="form-control" value="{{ $leaveRequest->leaveType->leave_name ?? 'N/A' }}({{$leaveRequest->leaveType->increase_rate ?? 'N/A' }})" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" value="{{ $leaveRequest->employee->email ?? 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="telegramNum" class="form-label">Telegram Num</label>
                        <input type="text" id="telegramNum" class="form-control" value="{{ $leaveRequest->employee->telegram_num ?? 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="approver" class="form-label">Approver</label>
                        <input type="text" id="approver" class="form-control" value="{{ $leaveRequest->approver->full_name ?? 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="subApprover" class="form-label">Sub-Approver</label>
                        <input type="text" id="subApprover" class="form-control" value="{{ $leaveRequest->subApprover->name ?? 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" id="status" class="form-control" value="{{ $leaveRequest->status }}" disabled>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" class="form-control" rows="3" disabled style="background-color: #FAE398;">{{ $leaveRequest->reason }}</textarea>
                    </div>
                    <div class="w-10">
                        <button class="w-5px mt-5 bg-blue-500 text-white font-bold py-2 px-4 hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors" style=" border-radius: 5px;">
                            <a href="{{ route('admin.leave.index') }}" class="btn-back" style=" text-decoration: none; color:white;">Back</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>