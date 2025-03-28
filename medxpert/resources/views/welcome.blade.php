<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <title>Doctor Amjad Daas - Appointment</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Doctor Profile Section -->
                    <div class="col-md-3 text-center">
                        <img
                            src="./my_pic.jfif"
                            class="rounded-circle mb-3 w-50 h-60"
                            alt="Dr. Amjad Daas" />
                        <h5 class="card-title">Doctor Amjad Daas</h5>
                        <p class="text-muted">{{$doctor['specialty']}}</p>

                        <!-- Star Rating -->
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p class="text-muted small">Overall Rating From 28 Visitors</p>
                    </div>

                    <!-- Doctor Details Section -->
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-tooth text-primary me-2"></i>
                                Dentist Specialized in {{$doctor['specialty']}}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                {{$doctor['city']}} : {{$doctor['clinic_address']}}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                Fees: 10 JOD
                            </li>
                            <li class="mb-2">
                                <i class="far fa-clock text-primary me-2"></i>
                                Waiting Time: 22 Minutes
                            </li>
                        </ul>
                    </div>

                    <!-- Appointment Slots Section -->
                    <div class="col-md-5">
                        <div class="d-flex justify-content-between mb-3">
                            <button class="btn btn-outline-primary">Today</button>
                            <button class="btn btn-outline-secondary">Tomorrow</button>
                            <button class="btn btn-outline-primary">Sat 03/29</button>
                        </div>

                        <div
                            class="d-flex justify-content-between align-items-center mb-3">
                            <i class="fas fa-chevron-left text-primary"></i>
                            <div>
                                <p class="text-muted mb-1">From 11:30 AM</p>
                                <p class="text-muted">To 5:30 PM</p>
                            </div>
                            <i class="fas fa-chevron-right text-primary"></i>
                        </div>

                        <div class="alert alert-warning small" role="alert">
                            No Available Appointments
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-danger">BOOK</button>
                        </div>

                        <p class="text-muted text-center small mt-2">
                            Reservation required, first-come, first-served
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Font Awesome JS -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>