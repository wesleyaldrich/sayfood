<head>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/popup-re.css') }}">
</head>
<!-- POP-UP REPORT RESTO FORM -->
<div class="card text-center p-4 shadow rounded" style="max-width: 400px; margin: auto;">
    <div class="d-flex justify-content-end align-items-start">
        <button type="button" onclick="closePopup()" style="background: none; border: none;">
            <img src="{{ asset('assets/btn_exit.png') }}" alt="exit-button" style="width: 35px; height: 35px;">
        </button>
    </div>

    <div class="card-body">
        <h1 class="title-report fw-bold" style="font-size:30px;">Report Restaurant</h1>
        <p style="margin-bottom: 10px;">Why do you want to report this restaurant?</p>

        <!-- OPTIONS SECTION -->
        <div id="report-options" class="d-grid gap-2 mb-3">
            <button type="button" class="btn btn-light border option-btn mb-2"
                onclick="selectOption(this, 'They sell expired foods')">They sell expired foods</button>
            <button type="button" class="btn btn-light border option-btn mb-2"
                onclick="selectOption(this, 'This resto is a scam')">This resto is a scam</button>
            <button type="button" class="btn btn-light border option-btn"
                onclick="selectOption(this, 'Bad hygiene')">Bad hygiene</button>
        </div>

        <!-- OTHERS SECTION -->
        <div class="w-100 rounded mb-3 border" style="padding: 12px; background: #ebebeb;">
            <div class="text-start mb-2 fw-semibold d-flex justify-content-center">Others :</div>
            <textarea class="form-control mb-4" placeholder="Write something..." rows="3"></textarea>
        </div>
        <button class="btn btn-success rounded-pill px-5 py-1" type="submit" style="background-color: #1d4d4f;"
            onclick="submitReport()">Submit</button>
    </div>
</div>
</div>