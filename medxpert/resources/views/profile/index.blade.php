@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .btn-primary {
        background-color: #0275d8;
        border-color: #0275d8;
    }

    .card-header {
        background-color: #0275d8;
        color: white;
    }

    .profile-sidebar {
        background-color: #0275d8;
        color: white;
        height: 100%;
        min-height: 100vh;
    }

    .profile-sidebar a {
        color: white;
        text-decoration: none;
        padding: 15px;
        display: block;
    }

    .profile-sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .main-content {
        padding: 20px;
    }

    .required::after {
        content: "*";
        color: red;
    }
</style>
<div class="container h-75 justify-content-center align-content-center">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <div class="row ">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center bg-primary">
                    <i class="fas fa-info-circle me-2"></i>
                    <h5 class="mb-0">Profile</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('password.change') }}" class="text-decoration-none">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-lock me-2"></i>
                            <span>Change Password</span>
                        </div>
                    </a>
                    <!-- Add more profile menu items here if needed -->
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="mb-0">Manage Profile</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('patientprofile.update') }}" method="POST">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-md-3 col-form-label text-md-end">Your Name<span class="text-danger">*</span></label>

                            <div class="col-md-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-md-3 col-form-label text-md-end">Email Address<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="age" class="col-md-3 col-form-label text-md-end">Age<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age',$patient->age) }}">
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="Chronc" class="col-md-3 col-form-label text-md-end">chronic_diseases<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('chronic_diseases') is-invalid @enderror" id="chronic_diseases" name="chronic_diseases" value="{{ old('chronic_diseases',$patientMedicalHistory->chronic_diseases) }}">
                                    @error('chronic_diseases')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="medications" class="col-md-3 col-form-label text-md-end">medications<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('medications') is-invalid @enderror" id="medications" name="medications" value="{{ old('medications',$patientMedicalHistory->medications) }}">
                                    @error('medications')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="allergies" class="col-md-3 col-form-label text-md-end">allergies<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('allergies') is-invalid @enderror" id="allergies" name="allergies" value="{{ old('allergies',$patientMedicalHistory->allergies) }}">
                                    @error('allergies')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-danger">SAVE</button>
                                <a href="{{ route('patientprofile') }}" class="btn btn-light ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card m-5">
    <div class="card-header bg-primary text-white  ">
        <h5 class="mb-0 d-flex justify-content-center align-items-center ">
            <span>My Appointments</span>
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Notes</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">

                                <div>
                                    <div class="fw-bold">Dr. {{$appointment->doctor->user->name }}</div>


                                </div>
                            </div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                        <td>
                            @if($appointment->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                            @elseif($appointment->status == 'confirmed')
                            <span class="badge bg-success">Confirmed</span>
                            @elseif($appointment->status == 'completed')
                            <span class="badge bg-info">Completed</span>
                            @elseif($appointment->status == 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>{{ $appointment->notes ?? 'No notes' }}</td>
                        <!-- <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewAppointmentModal{{ $appointment->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                @if($appointment->status == 'pending')
                                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editAppointmentModal{{ $appointment->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelAppointmentModal{{ $appointment->id }}">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                                @endif
                            </div>
                        </td> -->
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-calendar-x text-muted" style="font-size: 2rem;"></i>
                                <p class="mt-2 mb-0">No appointments found</p>
                                <button class="btn btn-sm btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#newAppointmentModal">
                                    Schedule an Appointment
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>