@extends('layout.app')
@section('title', 'Events Page')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">

    <div class="jumbotron jumbotron-custom text-white bg-dark">
        <div class="container-fluid px-0">
            <div class="row mx-0">
                <div class="col-3 p-3 mx-5 gap-3">
                    <h1 class="event-categories">EVENT<br>CATEGORIES</h1>
                </div>
                <div class="col px-0">
                    <div class="row mx-0">
                        <div class="col-md-3">
                            <button class="btn btn-cookingworkshop mt-2">
                                <img src="assets/cookingworkshop.jpg" style="width:200px; height:150px;"
                                    alt="Cooking Workshop">
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-fooddonation mt-2">
                                <img src="assets/fooddonation.jpg" style="width:200px; height:150px;" alt="Food Donation">
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-education mt-2">
                                <img src="assets/education.jpg" style="width:200px; height:150px;" alt="Education">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="py-0">
        <div class="col-md-12 px-5">
            <div class="row mb-4 mx-0">
                <!-- Recommended For You (Left Column) -->
                <div class="col-md-9 mb-3 mb-md-0">
                    <div class="recommended-section bg-white rounded p-4 h-100 shadow-sm">
                        <h5 class="fw-bold mb-3">RECOMMENDED FOR YOU</h5>
                        <div class="d-flex gap-3">
                            <div class="card recommended-card">
                                <img src="event.jpg" class="card-img-top" alt="Flavor & Favor" />
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">Flavor & Favor</h6>
                                    <p class="card-text small">Cooking for Good</p>
                                </div>
                            </div>
                            <div class="card recommended-card">
                                <img src="event.jpg" class="card-img-top" alt="Flavor & Favor" />
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">Flavor & Favor</h6>
                                    <p class="card-text small">Cooking for Good</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coming Soon (Right Column) -->
                <div class="col-md-3 p-0">
                    <div class="bg-dark-green text-white p-4 rounded h-100 shadow-sm">
                        <h6 class="fw-bold mb-4">Coming Soon</h6>

                        @for ($i = 0; $i < 2; $i++)
                            <div class="coming-item mb-3 d-flex align-items-center">
                                <div class="bg-cream rounded p-3 d-flex align-items-center w-100">
                                    <div class="date-box bg-orange text-white fw-bold text-center mx-0">
                                        <div class="date p-3">
                                            November<br />19
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-bold mx-2">Cooking Workshop</div>
                                        <div class="small mx-2">10:00 - 12:00</div>
                                    </div>
                                </div>
                            </div>
                        @endfor

                    </div>
                </div>

                <!-- Event List -->
                <div class="col-12">
                    <h5 class="text-center fw-bold my-4">
                        Let’s Start Your Journey With <span class="text-orange">SAYFOOD</span>!
                    </h5>
                </div>
                <div class="row g-4 mb-5 mx-0">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col-md-6">
                            <div class="card event-card p-3">
                                <div class="d-flex">
                                    <img src="event.jpg" alt="event" class="img-thumbnail me-3" width="120">
                                    <div>
                                        <h6 class="fw-bold">Flavor & Favor: Cooking for Good</h6>
                                        <p class="mb-2">Short description here...</p>
                                        <button class="btn btn-teal btn-sm">Join Event</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                <!-- Volunteering Section -->
                <div class="row text-center mx-0">
                    <div class="col-md-4">
                        <div class="volunteer-card p-4">
                            <div class="icon mb-3"><i class="bi bi-megaphone fs-2"></i></div>
                            <h6 class="fw-bold">VOLUNTEERING</h6>
                            <p class="small">Lorem ipsum dolor sit amet...</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="volunteer-card orange p-4">
                            <div class="icon mb-3"><i class="bi bi-megaphone fs-2"></i></div>
                            <h6 class="fw-bold">VOLUNTEERING</h6>
                            <p class="small">Lorem ipsum dolor sit amet...</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="volunteer-card p-4">
                            <div class="icon mb-3"><i class="bi bi-megaphone fs-2"></i></div>
                            <h6 class="fw-bold">VOLUNTEERING</h6>
                            <p class="small">Lorem ipsum dolor sit amet...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection