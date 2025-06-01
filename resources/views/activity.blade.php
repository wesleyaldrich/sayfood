@extends('layout.app')

@section('title', 'Activity Page')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
{{-- Pastikan Font Awesome CSS terhubung --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="{{ asset('js/activity.js') }}"></script>

@section('content')

<div class="container-fluid my-2 px-4">
    {{-- Wrapper for Header, Tabs, and Donation Card (THIS IS CORRECT FOR ITS POSITION) --}}
    <div class="header-tabs-donation-wrapper d-flex flex-column flex-lg-row justify-content-between align-items-start mb-4">
        <div class="left-section d-flex flex-column me-lg-4 mb-3 mb-lg-0">
            <h1>ACTIVITIES</h1>

            {{-- TAB CONTROL: ACTIVITIES & CHARITY ACTIVITIES --}}
            <ul class="nav nav-pills" id="activityTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active food-tab" id="food-tab" data-bs-toggle="pill" data-bs-target="#food-content" type="button" role="tab" aria-controls="food-content" aria-selected="true" href="#">FOOD ACTIVITIES</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link charity-tab" id="charity-tab" data-bs-toggle="pill" data-bs-target="#charity-content" type="button" role="tab" aria-controls="charity-content" aria-selected="false" href="#">CHARITY ACTIVITIES</a>
                </li>
            </ul>
        </div>

        {{-- Donation Info Card - This card should always be visible (based on your images) --}}
        {{-- Donation Info Card - This card should always be visible (based on your images) --}}
        <div class="card donation-info-card flex-shrink-0">
            <div class="card-body d-flex align-items-center justify-content-between p-4" style="position: relative;">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/mascot_donationaccumulation.svg') }}" alt="Donating Potato" class="me-3 donation-potato-img">
                    <div>
                        {{-- Pindahkan tombol toggle ke sini, sejajar dengan h5 --}}
                        <div class="d-flex align-items-center mb-1">
                            <h5 class="card-title mb-0 me-2">YOU'VE BEEN DONATING</h5>
                            <button type="button" class="btn btn-sm btn-link p-0 text-decoration-none" id="toggleDonationVisibility">
                                <i class="bi bi-eye-slash-fill" id="visibilityIcon"></i> {{-- Icon default: mata dicoret (sembunyi) --}}
                            </button>
                        </div>
                        {{-- Nominal donasi sekarang ada di bawahnya --}}
                        <p class="card-text mb-0 fs-4 fw-bold">
                            <span id="donationAmountValue">IDR 472.300,00</span>
                        </p>
                        <small class="text-muted d-block">this past 6 months, accumulated from your orders!</small>
                        <a href="#" class="d-block mt-2 check-in-action-link">"Charity is love in action."</a>
                    </div>
                </div>
                <img src="{{ asset('assets/bg_donationaccumulation.svg') }}" alt="Money Bag" class="donation-piggy-bank-img ms-3">
            </div>
        </div>
    </div>
    {{-- END HEADER-TABS-DONATION-WRAPPER --}}

    {{-- SINGLE TAB CONTENT CONTAINER --}}
    <div class="tab-content" id="activityTabContent">
        {{-- TAB PANE: FOOD ACTIVITIES CONTENT --}}
        <div class="tab-pane fade show active" id="food-content" role="tabpanel" aria-labelledby="food-tab">
            {{-- Konten LIST AKTIVITAS MAKANAN akan berada di sini --}}
            {{-- Ini adalah tempat untuk semua activity-main-item --}}
            <div class="activity-list">
                @php
                    $orderStatuses = [
                        ['status' => 'order_created'],
                        ['status' => 'order_accepted'],
                        ['status' => 'in_progress'],
                        ['status' => 'ready_to_pickup'],
                        ['status' => 'order_completed'],
                        ['status' => 'review_order'],
                    ];
                @endphp

                @foreach ($orderStatuses as $index => $orderData)
                    <div class="card activity-main-item mb-3">
                        <div class="card-header activity-header d-flex align-items-center justify-content-between p-3"
                             style="background-color: #EE8D4A; border-bottom: 1px solid #eee; border-radius: 10px 10px 0 0;">
                            <div class="d-flex flex-column me-3 activity-item-date">
                                <span class="fw-bold" style="color: black;">ORDER PLACED</span>
                                <small class="text-muted">25 May 2025</small>
                            </div>
                            <div class="d-flex flex-column me-3 activity-item-total">
                                <span class="fw-bold" style="color: black;">TOTAL</span>
                                <span class="text-success fw-bold">IDR 50.000,00</span>
                            </div>
                            <div class="d-flex flex-column flex-grow-1 me-3 activity-item-location">
                                <span class="fw-bold" style="color: black;">PICK UP LOCATION</span>
                                <span>Restoran Ny. Nita Jl. Pakuan No.3, Sumur Batu, Babakan Madang, Bogor</span>
                            </div>
                            <div class="d-flex align-items-center activity-item-actions">
                                <button class="btn btn-sm rounded-pill px-3 me-2 btn-ready-pickup">Ready to Pick Up</button>
                                <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 dropdown-toggle" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#detailsCollapseFood{{ $index }}"
                                        aria-expanded="false" aria-controls="detailsCollapseFood{{ $index }}">
                                    See Details
                                </button>
                            </div>
                        </div>

                        <div class="collapse" id="detailsCollapseFood{{ $index }}">
                            <div class="card-body details-section p-4">
                                <p class="details-title">DETAILS :</p>
                                <div class="order-items mb-4">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Bubur Sukabumi</span>
                                        <span>x1</span>
                                        <span>IDR 6.000,00</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Lemongrass Tea</span>
                                        <span>x1</span>
                                        <span>IDR 1.000,00</span>
                                    </div>
                                </div>
                                <div class="order-status-timeline d-flex justify-content-between align-items-center mb-4">
                                    @php
                                        $statuses = [
                                            'Order Created' => 'order_created',
                                            'Order Accepted' => 'order_accepted',
                                            'In Progress' => 'in_progress',
                                            'Ready to Pickup' => 'ready_to_pickup',
                                            'Order Completed' => 'order_completed',
                                            'Review Order' => 'review_order'
                                        ];
                                        $currentStatusReached = false;
                                    @endphp
                                    @foreach ($statuses as $label => $key)
                                        @php
                                            $isActive = false;
                                            if ($orderData['status'] == $key) {
                                                $isActive = true;
                                                $currentStatusReached = true;
                                            } elseif (!$currentStatusReached) {
                                                $isActive = true;
                                            }
                                        @endphp
                                        <div class="timeline-step text-center {{ $isActive ? 'active-step' : '' }}">
                                            <div class="circle d-flex justify-content-center align-items-center">
                                                <i class="fas fa-check"></i>
                                                <span class="icon-placeholder"></span>
                                            </div>
                                            <p class="status-label mt-2">{{ $label }}</p>
                                        </div>
                                        @if (!$loop->last)
                                            <div class="line {{ $isActive ? 'active-line' : '' }}"></div>
                                        @endif
                                    @endforeach
                                </div>
                                <button class="btn btn-warning review-order-btn d-block mx-auto px-5 py-2 rounded-pill">Review Order</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- TAB PANE: CHARITY ACTIVITIES CONTENT --}}
        <div class="tab-pane fade" id="charity-content" role="tabpanel" aria-labelledby="charity-tab">
            <div class="alert alert-info" role="alert">
                Charity activities will be displayed here.
            </div>
            {{-- List aktivitas charity (jika ada) --}}
            @for ($i = 0; $i < 2; $i++)
                <div class="activity-item d-flex align-items-center justify-content-between p-3 mb-3 rounded-3" style="background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,.05);">
                    <div class="d-flex flex-column me-3">
                        <span class="fw-bold">DONATION MADE</span>
                        <small class="text-muted">20 May 2023</small>
                    </div>
                    <div class="d-flex flex-column me-3">
                        <span class="fw-bold">AMOUNT</span>
                        <span class="text-info fw-bold">IDR 10.000,00</span>
                    </div>
                    <div class="d-flex flex-column flex-grow-1 me-3">
                        <span class="fw-bold">CAMPAIGN</span>
                        <span>"Food for Homeless in Bogor"</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary btn-sm rounded-pill px-3 dropdown-toggle" type="button" id="dropdownMenuButtonCharity{{ $i }}" data-bs-toggle="dropdown" aria-expanded="false">
                            View Details
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonCharity{{ $i }}">
                            <li><a class="dropdown-item" href="#">Charity Detail 1</a></li>
                            <li><a class="dropdown-item" href="#">Charity Detail 2</a></li>
                        </ul>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    {{-- END SINGLE TAB CONTENT CONTAINER --}}
</div>


@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const donationAmountValue = document.getElementById('donationAmountValue');
    const toggleButton = document.getElementById('toggleDonationVisibility');
    const visibilityIcon = document.getElementById('visibilityIcon');

    console.log('Script Donasi Dimuat.');
    console.log('donationAmountValue:', donationAmountValue);
    console.log('toggleButton:', toggleButton);
    console.log('visibilityIcon:', visibilityIcon);

    if (donationAmountValue && toggleButton && visibilityIcon) {
        console.log('Semua elemen yang diperlukan ditemukan.');

        function setDonationVisibility(isVisible) {
            if (isVisible) {
                donationAmountValue.style.filter = 'none';
                visibilityIcon.classList.remove('bi-eye-fill');
                visibilityIcon.classList.add('bi-eye-slash-fill');
            } else {
                donationAmountValue.style.filter = 'blur(5px)';
                visibilityIcon.classList.remove('bi-eye-slash-fill');
                visibilityIcon.classList.add('bi-eye-fill');
            }
            localStorage.setItem('hideDonationAmount', !isVisible);
        }

        const hideAmountFromStorage = localStorage.getItem('hideDonationAmount') === 'true';
        setDonationVisibility(!hideAmountFromStorage);

        toggleButton.addEventListener('click', function() {
            console.log('Tombol toggle diklik!');
            const currentVisibility = donationAmountValue.style.filter === 'none';
            setDonationVisibility(!currentVisibility);
        });
    } else {
        console.error('Satu atau lebih elemen untuk toggle donasi tidak ditemukan.');
    }
});
</script>
@endpush
