<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/report-detail.css') }}">
    <nav class="navbar nav-admin-report">
    </nav>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<body>
    <div class="container mx-4 my-5">
        <div class="row align-items-center">
            <div class="navigation-buttons mb-3">
                <button class="nav-btn" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <button class="nav-btn ms-3" onclick="goUp()">
                    <i class="fas fa-chevron-up"></i>
                </button>
                <button class="nav-btn" onclick="goDown()">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>

            {{-- Kolom Kiri: Profile --}}
            <div class="col-md-9 d-flex align-items-center">
                <div class="profile-report">
                    <img src="{{ asset('assets/icon_profile.png') }}" alt="profile_img"
                        style="width: 100px; height: 100px;">
                </div>
                <div class="ms-3">
                    <h1 class="fw-bold mb-0" style="color: #234C4C;">Upin Cucu Opah</h1>
                    <h5 class="text-muted mb-0 my-1">123455678</h5>
                </div>
            </div>

            {{-- Kolom Kanan: Tombol --}}
            <div class="col-md-3 text-md-end text-start mt-3 mt-md-0">
                <button class="btn"
                    style="background-color: #234C4C; color: white; border-radius: 6px; padding: 6px 12px;">
                    <i class="bi bi-check-lg me-2"></i> In Review
                </button>
            </div>
        </div>
    </div>

    <div class="mx-5 mt-5">
        <h3 class="report-details fw-bold" style="color: #234C4C; font-size: 20px;">Report Details</h3>
        <div class="row mt-3">
            <div class="col-12">
                <div class="row mb-3">
                    <div class="col">
                        <p class="mb-1">
                            <strong><i class="fas fa-bell me-2" style="color: #234C4C;"></i>Status:</strong>
                        </p>
                        <span class="badge text-white"
                            style="background: #FEA322; width: 100px; height: 25px;">Pending</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p class="mb-1">
                            <strong><i class="fas fa-envelope me-2" style="color: #234C4C;"></i>Email:</strong>
                        </p>
                        <p>upin123@gmail.com</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <p class="mb-1">
                            <strong><i class="fas fa-circle-info me-2" style="color: #234C4C;"></i>Description:</strong>
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pulvinar urna eu ante
                            dignissim aliquet. Nam orci erat, laoreet ut laoreet vitae, elementum vitae lectus. Aliquam
                            et
                            tincidunt tellus. Nulla mollis viverra consectetur. Aliquam luctus maximus felis, vel
                            placerat augue
                            auctor ac. Donec hendrerit dolor in ante condimentum vestibulum. Quisque scelerisque, erat
                            sed
                            vehicula gravida, nisl lorem volutpat lectus, in aliquam odio diam nec massa. Suspendisse
                            tempus
                            viverra fermentum. Fusce fermentum enim quam, quis scelerisque metus lacinia vel. Morbi
                            placerat mi
                            in nulla ultricies feugiat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>