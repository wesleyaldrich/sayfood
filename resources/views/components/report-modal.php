<!-- Tambahkan di <head> jika belum -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- MODAL REPORT RESTAURANT -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('report.store') }}" method="POST" class="modal-content p-4 shadow rounded">
            @csrf
            <!-- Hidden Inputs (kirim ID customer & restaurant jika perlu) -->
            <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center">
                <h1 class="fw-bold mb-3" style="font-size: 28px;">Report Restaurant</h1>
                <p class="mb-3">Why do you want to report this restaurant?</p>

                <!-- Pilihan alasan -->
                <div id="report-options" class="d-grid gap-2 mb-3">
                    <button type="button" class="btn btn-light border option-btn"
                        onclick="selectOption(this, 'They sell expired foods')">They sell expired foods</button>
                    <button type="button" class="btn btn-light border option-btn"
                        onclick="selectOption(this, 'This resto is a scam')">This resto is a scam</button>
                    <button type="button" class="btn btn-light border option-btn"
                        onclick="selectOption(this, 'Bad hygiene')">Bad hygiene</button>
                </div>

                <!-- Textarea untuk others -->
                <div class="form-group mb-3">
                    <label class="fw-semibold">Others:</label>
                    <textarea name="description" class="form-control" placeholder="Write something..." rows="3"></textarea>
                </div>

                <input type="hidden" name="selected_reason" id="selectedReasonInput">

                <button type="submit" class="btn btn-success rounded-pill px-5 py-1" style="background-color: #1d4d4f;">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
