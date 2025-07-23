<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/report-detail.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <nav class="navbar nav-admin-report">
    </nav>
</head>

<body>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

    <div class="container mx-4 my-5">
        <h1 class="fw-bold mb-0" style="color: #234C4C; font-family: 'Oswald', sans-serif;">REPORT</h1>

        <div class="d-flex justify-content-between align-items-center flex-wrap my-3">
            <!-- Filter Buttons -->
            <div class="btn-filter d-flex gap-2 flex-wrap text-white">
                <button class="btn rounded-pill btn-oswald text-white" type="button"
                    style="background:#FEA322; width: 100px; border: none;">All</button>
                <button class="btn rounded-pill btn-oswald text-white" type="button"
                    style="background:#234C4C; width: 130px; border: none;">Pending</button>
                <button class="btn rounded-pill btn-oswald text-white" type="button"
                    style="background:#234C4C; width: 130px; border: none;">In Review</button>
                <button class="btn rounded-pill btn-oswald text-white" type="button"
                    style="background:#234C4C; width: 130px; border: none;">Resolved</button>
            </div>

            <!-- Search Bar -->
            <div class="search-box ms-auto mt-2 mt-md-0">
                <div class="input-group rounded-pill border overflow-hidden" style="width: 300px;">
                    <span class="input-group-text bg-white border-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-0" placeholder="Search">
                </div>
            </div>
        </div>
    </div>


    <div style="overflow-x: auto; width: 100%; padding-right: 10px; padding-left: 10px;">
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 0; background-color: #F8F4E9;">
            <thead style="border-bottom: 0.5px solid #000;">
                <tr>
                    <th style="padding: 12px 16px; text-align: left;">ID</th>
                    <th style="padding: 12px 16px; text-align: left;">Name</th>
                    <th style="padding: 12px 70px; text-align: left;">Email</th>
                    <th style="padding: 12px 150px; text-align: left;">Resto ID</th>
                    <th style="padding: 12px 16px; text-align: left;">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $statuses = ['Pending', 'In Review', 'Resolved'];
                    $colors = [
                        'Pending' => 'background-color: #f59e0b; color: white; width: 150px; height: 30px;',
                        'In Review' => 'background-color: #0f766e; color: white; width: 150px; height: 30px;',
                        'Resolved' => 'background-color: #064e3b; color: white; width: 150px; height: 30px;',
                    ];
                @endphp

                @for ($i = 0; $i < 10; $i++)
                    @php
                        $status = $statuses[$i % 3];
                        $reportId = 1000 + $i; // contoh id untuk routing
                    @endphp
                    <tr style="background: #F8F4E9;">
                        <td
                            style="padding: 5px 16px; border-top: 0.5px solid black; border-bottom: 0.5px solid rgba(0,0,0,0.1);">
                            12345678
                        </td>
                        <td
                            style="padding: 5px 70px; border-top: 0.5px solid black; border-bottom: 0.5px solid rgba(0,0,0,0.1);">
                            Upin Cucu Opah
                        </td>
                        <td
                            style="padding: 5px 16px; border-top: 0.5px solid black; border-bottom: 0.5px solid rgba(0,0,0,0.1);">
                            upin123@gmail.com
                        </td>
                        <td
                            style="padding: 5px 150px; border-top: 0.5px solid black; border-bottom: 0.5px solid rgba(0,0,0,0.1);">
                            11089012
                        </td>
                        <td
                            style="padding: 1px 0px; border-top: 0.5px solid black; border-bottom: 0.5px solid rgba(0,0,0,0.1);">
                            <form action="{{ route('report.resto.detail', ['id' => $reportId]) }}" method="get"
                                style="display:inline;">
                                <button type="submit" style="
                                    border: none;
                                    cursor: pointer;
                                    border-radius: 9999px;
                                    font-weight: 500;
                                    font-size: 0.9rem;
                                    text-align: center;
                                    padding: 1px 0;
                                    {{ $colors[$status] }}
                                ">
                                    {{ $status }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</body>