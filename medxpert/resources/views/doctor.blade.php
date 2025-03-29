<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Doctor Appointment</title>
</head>

<body style="background-color: aliceblue;">

    @foreach ($doctors as $doctor)
    <div class="container mt-3 border-4 border-primary p-4">
        <div class="card">
            <div class="card-body">
                <div class="row badge-dark hight">
                    <!-- Doctor Profile Section -->
                    <div class="col-md-3 text-center ">
                        <img src="{{$doctor->doctor_details['image']}}" class="rounded-circle mb-3  m-auto fit-image img-thumbnail"
                            style="height: 170px; width:170px" alt="Doctor Image" />
                        <h5 class="card-title">{{$doctor->user['name']}}</h5>
                        <p class="text-muted">{{ $doctor->doctor_details['specialty'] }}</p>

                        <h5 class="text-muted small">Doctor Rating</h5>
                        <div class="text-warning mb-2">
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $doctor->doctor_details['rating']) {
                                    echo "<i class='fas fa-star'></i>";
                                } else {
                                    echo "<i class='far fa-star'></i>";
                                }
                            }
                            ?>
                        </div>
                        <p class="text-muted small">Overall Rating From 28 Visitors</p>
                    </div>

                    <!-- Doctor Details Section -->
                    <div class="col-md-4">
                        <ul class="list-unstyled mt-4">
                            <li class="mb-2">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                {{$doctor->doctor_details['city']}} : {{$doctor->doctor_details['clinic_address']}}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                Fees: {{$doctor->doctor_details['price']}} JOD
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
                        $dates = $groupedAppointments->keys(); // Get all available dates
                        $dateCount = count($dates);
                        @endphp

                        @if($dateCount > 0)
                        <!-- Date Navigation -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button class="btn btn-outline-primary prev-date" data-doctor-id="{{ $doctor->id }}" disabled>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <h5 id="appointment-date-{{ $doctor->id }}" class="text-primary text-center">
                                {{ \Carbon\Carbon::parse($dates[0])->format('l, F j, Y') }}
                            </h5>
                            <button class="btn btn-outline-primary next-date" data-doctor-id="{{ $doctor->id }}">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        <div id="appointment-container-{{ $doctor->id }}">
                            @foreach ($groupedAppointments as $date => $appointmentsForDate)
                            <div class="appointment-day" data-date="{{ $date }}" style="display: none;">
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

                                    <!-- Modal for Appointment Confirmation -->
                                    <div class="modal fade" id="appointmentModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="appointmentModalLabel">Confirm Your Appointment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Doctor:</strong> {{ $doctor->user['name'] }}</p>
                                                    <p><strong>Specialty:</strong> {{ $doctor->doctor_details['specialty'] }}</p>
                                                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}</p>
                                                    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                                                    <p><strong>Clinic:</strong> {{ $doctor->doctor_details['clinic_address'] }}, {{ $doctor->doctor_details['city'] }}</p>
                                                    <p><strong>Price:</strong> {{ $doctor->doctor_details['price'] }} JOD</p>
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
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Bootstrap and Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".appointment-day").forEach((day, index) => {
                if (index === 0) day.style.display = "block"; // Show first date
            });

            document.querySelectorAll(".next-date, .prev-date").forEach(button => {
                button.addEventListener("click", function() {
                    let doctorId = this.getAttribute("data-doctor-id");
                    let container = document.querySelector("#appointment-container-" + doctorId);
                    let dateDisplay = document.querySelector("#appointment-date-" + doctorId);
                    let dates = Array.from(container.querySelectorAll(".appointment-day"));

                    let currentIndex = dates.findIndex(day => day.style.display === "block");
                    dates[currentIndex].style.display = "none";

                    if (this.classList.contains("next-date")) {
                        currentIndex++;
                    } else {
                        currentIndex--;
                    }

                    dates[currentIndex].style.display = "block";
                    dateDisplay.textContent = dates[currentIndex].getAttribute("data-date"); // Update date title

                    // Enable/disable arrows based on index
                    let prevButton = document.querySelector(`.prev-date[data-doctor-id="${doctorId}"]`);
                    let nextButton = document.querySelector(`.next-date[data-doctor-id="${doctorId}"]`);

                    prevButton.disabled = (currentIndex === 0);
                    nextButton.disabled = (currentIndex === dates.length - 1);
                });
            });
        });
    </script>

</body>

</html>