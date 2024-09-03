<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="container mt-20" style="padding: 5%;">
        <div class="card shadow-sm mx-auto px-4 py-6 bg-white text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <img src="../images/Mr_cat.jpg" alt="Profile Picture" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                <h3 class="p-4 d-flex justify-content-center text-warning"><b> User Information</b></h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label for="userId" class="form-label">User ID</label>
                        <input type="text" id="userId" class="form-control " value="1" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" id="fullName" class="form-control" value="Kris Wang" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" id="gender" class="form-control" value="Female" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" id="department" class="form-control" value="IT" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" id="position" class="form-control" value="Front-End Developer" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="leaveDates" class="form-label">From | To</label>
                        <input type="text" id="leaveDates" class="form-control" value="28.08.2024 - 30.08.2024" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="leaveType" class="form-label">Leave Type</label>
                        <input type="text" id="leaveType" class="form-control" value="Sick Leave" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" value="kriswang@gmail.com" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="telegramNum" class="form-label">Telegram Num</label>
                        <input type="text" id="telegramNum" class="form-control" value="015637286" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="approver" class="form-label">Approver</label>
                        <input type="text" id="approver" class="form-control" value="Mr. Cat" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="subApprover" class="form-label">Sub-Approver</label>
                        <input type="text" id="subApprover" class="form-control" value="Mr. Cat" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" id="status" class="form-control" value="Pending" disabled>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" class="form-control" rows="3" disabled style="background-color: #FAE398;">Dear boss, I would like to take leave 1 day, because I'm feeling sick</textarea>
                    </div>
                    <div class="w-10">
                        <button class="w-5px mt-5 bg-blue-500 text-white font-bold py-2 px-4 hover:bg-yellow-400 focus:outline-none focus:bg-blue-700 transition-colors" style=" border-radius: 5px;"><a href="/admin/dashboard" class="btn-back" style=" text-decoration: none; color:white;">Back</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>