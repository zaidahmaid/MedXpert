<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Doctor Appointment</title>

</head>
@extends('layouts.app')

@section('title', 'doctor')



@section('content')

<body style="background-color: aliceblue; ">
    <form action="{{ route('doc') }}" method="GET" class="search-box p-6 md:p-8 max-w-6xl m-auto mt-4 transform transition-all duration-300 hover:shadow-xl">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-8 gap-4">
            <div class="md:col-span-2">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Doctor Name</label>
                <div class="relative">
                    <select name="doctor_id" class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none transition">
                        <option value="">All Doctors</option>
                        @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">Dr. {{ $doctor->user->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div class="md:col-span-1">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Select Specialty</label>
                <div class="relative">
                    <select name="specialty" class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none transition">
                        <option value="">All Specialties</option>
                        @foreach($specialties as $specialty)
                        <option value="{{ $specialty }}">{{ $specialty }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div class="md:col-span-1">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Location</label>
                <div class="relative">
                    <select name="city" class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none transition">
                        <option value="">All Areas</option>
                        @foreach($cities as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Price Range</label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="number" name="min_price" placeholder="Min Price" class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <input type="number" name="max_price" placeholder="Max Price" class="w-full p-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>
            <div class="md:col-span-1">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Find Doctor</label>
                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-md">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
            </div>
            <div class="md:col-span-1 ">
                <label class="block text-gray-700 text-sm font-semibold mb-4">Find Doctor</label><a href="{{ route('doc') }}" class="w-full py-3 px-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-md "><i class="fa-solid fa-arrows-rotate me-2" style="color: #ffffff;"></i>Reset</a>
            </div>
        </div>
        </div>

    </form>




    @foreach ($doctors as $doctor)
    <div class="container mt-3 border-primary p-4" ">
        <div class=" card">
        <div class="card-body">
            <div class="row badge-dark hight">
                <!-- Doctor Profile Section -->
                <div class="col-md-3 text-center ">
                    <img src="{{$doctor->doctorDetails['image']}}" class="rounded-circle mb-3  m-auto fit-image img-thumbnail"
                        style="height: 170px; width:170px" alt="Doctor Image" />
                    <h5 class="card-title">{{$doctor->user['name']}}</h5>



                </div>

                <!-- Doctor Details Section -->
                <div class="col-md-4">
                    <ul class="list-unstyled mt-4">
                        <li class="mb-2"><i class="fas fa-stethoscope text-primary me-2"></i>Doctor specialty: {{ $doctor->doctorDetails['specialty'] }}</li>
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            {{$doctor->doctorDetails['city']}} : {{$doctor->doctorDetails['clinic_address']}}
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-money-bill-wave text-primary me-2"></i>
                            Fees: {{$doctor->doctorDetails['price']}} JOD
                        </li>
                        <!-- <li class="mb-2">
                            <i class="far fa-clock text-primary me-2"></i>
                            Waiting Time: 22 Minutes
                        </li> -->
                        <li class="mb-2"><i class='fas fa-star text-primary'></i> Doctor Rating:
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $doctor->doctorDetails['rating']) {
                                    echo "<i class='fas fa-star text-primary'></i>";
                                } else {
                                    echo "<i class='far fa-star text-primary'></i>";
                                }
                            }
                            ?>
                        </li>
                        <li><a href="{{ route('doctor.profile', $doctor->id) }}" class="text-blue-600 hover:underline">View Profile</a></li>

                    </ul>
                </div>

                <!-- Appointment Slots Section -->
                <div class="col-md-5">

                    @php
                    $groupedAppointments = $appointments->where('doctor_id', $doctor->id)->groupBy('date');
                    $dates = $groupedAppointments->keys()->sort()->values()->all();


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
                        <div class="appointment-day" data-date="{{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}">
                            <div class="row">
                                @foreach ($appointmentsForDate as $appointment)
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">Time:</h6>
                                            <p class="card-text">{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</p>

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
                                                <p><strong>Specialty:</strong> {{ $doctor->doctorDetails['specialty'] }}</p>
                                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }}</p>
                                                <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</p>
                                                <p><strong>Clinic:</strong> {{ $doctor->doctorDetails['clinic_address'] }}, {{ $doctor->doctorDetails['city'] }}</p>
                                                <p><strong>Price:</strong> {{ $doctor->doctorDetails['price'] }} JOD</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('doc.book') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="slot_id" value="{{ $appointment->id }}">
                                                    <button type="submit" class="btn btn-primary">Book Now</button>
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
    @endsection

    <!-- Bootstrap and Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // For each doctor, initialize their appointment days
            document.querySelectorAll(".container").forEach(container => {
                // Get doctor ID from the container
                let doctorIdElement = container.querySelector("[data-doctor-id]");
                if (!doctorIdElement) return; // Skip if no doctor ID element found

                let doctorId = doctorIdElement.getAttribute("data-doctor-id");
                let appointmentContainer = container.querySelector("#appointment-container-" + doctorId);

                if (!appointmentContainer) return; // Skip if no appointment container found

                // Get all appointment days for this specific doctor
                let appointmentDays = appointmentContainer.querySelectorAll(".appointment-day");

                // Sort appointment days by date if needed
                let sortedDays = Array.from(appointmentDays);
                sortedDays.sort((a, b) => {
                    let dateA = new Date(a.getAttribute("data-date"));
                    let dateB = new Date(b.getAttribute("data-date"));
                    return dateA - dateB;
                });

                // Hide all days first
                sortedDays.forEach(day => {
                    day.style.display = "none";
                });

                // Show only the first date for this doctor
                if (sortedDays.length > 0) {
                    sortedDays[0].style.display = "block";

                    // Update the date display
                    let dateDisplay = container.querySelector("#appointment-date-" + doctorId);
                    if (dateDisplay) {
                        dateDisplay.textContent = sortedDays[0].getAttribute("data-date");
                    }
                }

                // Setup navigation buttons for this doctor
                let prevButton = container.querySelector(`.prev-date[data-doctor-id="${doctorId}"]`);
                let nextButton = container.querySelector(`.next-date[data-doctor-id="${doctorId}"]`);

                if (prevButton && nextButton) {
                    // Initially disable prev button (since we're on first date)
                    prevButton.disabled = true;
                    // If only one date, disable next button too
                    nextButton.disabled = sortedDays.length <= 1;

                    // Add event listeners for navigation
                    [prevButton, nextButton].forEach(button => {
                        button.addEventListener("click", function() {
                            let currentIndex = sortedDays.findIndex(day => day.style.display === "block");

                            // Hide current day
                            sortedDays[currentIndex].style.display = "none";

                            // Calculate new index
                            if (this.classList.contains("next-date")) {
                                currentIndex++;
                            } else {
                                currentIndex--;
                            }

                            // Show new day
                            sortedDays[currentIndex].style.display = "block";

                            // Update date display
                            let dateDisplay = container.querySelector("#appointment-date-" + doctorId);
                            if (dateDisplay) {
                                dateDisplay.textContent = sortedDays[currentIndex].getAttribute("data-date");
                            }

                            // Update button states
                            prevButton.disabled = (currentIndex === 0);
                            nextButton.disabled = (currentIndex === sortedDays.length - 1);
                        });
                    });
                }
            });
        });
    </script>

</body>


</html>