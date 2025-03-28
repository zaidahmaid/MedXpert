<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <title>Doctor Appointment</title>
</head>

<body>

    @foreach ($doctors as $doctor)
    <div class="container mt-3 border-4 border-primary p-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Doctor Profile Section -->
                    <div class="col-md-3 text-center ">
                        <img
                            src="{{$doctor['image']}}"
                            class="rounded-circle mb-3  m-auto fit-image img-thumbnail"
                            style="height: 170px; width:170px"
                            alt="Dr. Amjad Daas" />
                        <h5 class="card-title">{{$doctor->user['name']}}</h5>
                        <p class="text-muted">{{ $doctor['specialty'] }}</p>

                        <!-- Star Rating -->
                        <h5 class="text-muted small">Doctor Rating</h5>
                        <div class="text-warning mb-2">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $doctor['rating']) {
                                    echo "<i class='fas fa-star'></i>";
                                } else {
                                    echo "<i class='far fa-star'></i>";
                                }
                            }
                            ?>
                        </div>
                        <p class=" text-muted small">Overall Rating From 28 Visitors</p>
                    </div>

                    <!-- Doctor Details Section -->
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                {{$doctor['city']}} : {{$doctor['clinic_address']}}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                Fees: {{$doctor['price']}} JOD
                            </li>
                            <li class="mb-2">
                                <i class="far fa-clock text-primary me-2"></i>
                                Waiting Time: 22 Minutes
                            </li>
                        </ul>
                    </div>

                    <!-- Appointment Slots Section -->
                    <div class="col-md-5">
                        @php
                        $groupedAppointments = $appointments->where('doctor_id', $doctor->id)->groupBy('appointment_date');
                        @endphp

                        @foreach ($groupedAppointments as $date => $appointmentsForDate)
                        <h5 class="text-primary text-center mt-3">{{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}</h5> <!-- Display Date as Header -->

                        <div class="row">
                            @foreach ($appointmentsForDate as $appointment)
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">Time:</h6>
                                        <p class="card-text">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>

                                        <!-- Button to trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#appointmentModal{{ $appointment->id }}">
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Bootstrap Modal for Confirmation -->
                            <div class="modal fade" id="appointmentModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="appointmentModalLabel">Confirm Your Appointment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Doctor:</strong> {{ $doctor->user['name'] }}</p>
                                            <p><strong>Specialty:</strong> {{ $doctor['specialty'] }}</p>
                                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}</p>
                                            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                                            <p><strong>Clinic:</strong> {{ $doctor['clinic_address'] }}, {{ $doctor['city'] }}</p>
                                            <p><strong>Price:</strong> {{ $doctor['price'] }} JOD</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('appointments.book') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                                <button type="submit" class="btn btn-success">Confirm Booking</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Bootstrap and Font Awesome JS -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>