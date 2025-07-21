@extends('layout.app')
@section('title', 'Cart')

{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}


@section('content')
<script>
    const paymentTranslations = @json(__('foods'));
</script>

    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

    <div class="breadcrumb-nav d-flex align-items-center mb-3">
        <a href="/foods" class="breadcrumb-link">{{ __('foods.foods') }}</a>
        <span class="mx-2">></span>
        <span class="text-muted">{{ __('foods.cart') }}</span>
    </div>

    @if($restaurant)
        <div class="pickup-location-tab d-flex align-items-center">
            <img class="pickup-location-icon" src="assets/icon_location.png" alt="Pickup Location">
            <span class=mx-2>{{ __('foods.pickup_location') }}</span>
        </div>

        <div class="pickup-address-tab pb-3">
            <p class="restaurant-name">{{$restaurant->name}}</p>
            <p class="restaurant-address">{{$restaurant->address}}</p>
        </div>
    @endif

    <div class="transaction-section">
        <div class="added-to-cart-container">
            <div class="title">
                <p style="color:white" class="my-0">{{ __('foods.added_to_cart') }}</p>
            </div>
            @foreach ($cartItems as $item)
                <x-cart-item :item="$item" />
            @endforeach
            
            <div class="button-section">
                <a href="foods">
                    <button class="add-more-btn">
                        <p style="color:white" class="my-0">{{ __('foods.add_more') }}</p>
                    </button>
                </a>
            </div>
        </div>
        <div class="payment-contents-right-side">
            <div class="payment-container">
                <div class="title">
                    <p style="color:white" class="my-0">{{ __('foods.payment_summary') }}</p>
                </div>
                <div class="product-details">
                    @if ($cartItems->isEmpty())
                    <p>{{ __('foods.your_cart_empty') }}</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">{{ __('foods.food') }}</th>
                            <th scope="col">{{ __('foods.qty') }}</th>
                            <th scope="col">{{ __('foods.price') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @php $total = 0; @endphp
                            @foreach ($cartItems as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$item->food->name}}</td>
                                    <td>x{{$item->quantity}} </td>
                                    <td>IDR {{ number_format($item->food->price * $item->quantity, 0, ',', '.') }},00</td>
                                </tr>
                                @php $total += $item->food->price * $item->quantity; @endphp
                            @endforeach
                            </tbody>
                        <tfoot class="total-price-section">
                            <tr>
                            <th scope="row"></th>
                            <td>{{ __('foods.total_price') }}</td>
                            <td></td>
                            <td>IDR {{ number_format($total, 0, ',', '.') }},00</td>
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                </div>
            </div>
            <div class="payment-buttons">
                <form action="{{ route('cart.cancel') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="cancel-order-btn" onclick="return confirm('Are you sure you want to clear your entire cart?');">
                        <p style="color: white" class="my-0">{{ __('foods.cancel') }}</p>
                    </button>
                </form>

                <button class="checkout-btn" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                    <p style="color: white" class="my-0">{{ __('foods.checkout') }}</p>
                </button>
            </div>
        </div>
    </div>

    <form id="addNoteForm" method="POST" action="">
        @csrf
        <x-popup-modal id="addNoteModal" title="Add Notes">
                <p class="text-muted">{{ __('foods.write') }}</p>
                <textarea id="noteTextarea" name="notes" class="form-control" rows="4" placeholder="{{ __('foods.example') }}"></textarea>
                
                <x-slot name="footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('foods.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('foods.save_changes') }}</button>
                </x-slot>
        </x-popup-modal>
    </form>

{{-- MODAL 1: SELECT PAYMENT METHOD --}}
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">{{ __('foods.select_payment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>{{ __('foods.select_payment_clue') }}</h6>
                <div class="list-group mt-3">
                    <label for="paymentBca" class="list-group-item list-group-item-action d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentBca" value="bca_va" checked>
                        <img src="{{ asset('assets/payment_gateway_images/logobca.png') }}" alt="BCA" class="payment-logo ms-3 me-3">
                        <span>BCA Virtual Account</span>
                    </label>
                    <label for="paymentQris" class="list-group-item list-group-item-action d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentQris" value="qris">
                        <img src="{{ asset('assets/payment_gateway_images/logoqris.png') }}" alt="QRIS" class="payment-logo ms-3 me-3" style="width: 50px;">
                        <span>QRIS</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('foods.cancel') }}</button>
                <button type="button" class="btn btn-success" id="proceedToPaymentBtn" data-bs-dismiss="modal">{{ __('foods.proceed_payment') }}</button>            </div>
        </div>
    </div>
</div>


{{-- MODAL 2: PAYMENT DETAILS & CONFIRMATION --}}
<div class="modal fade" id="paymentDetailsModal" tabindex="-1" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentDetailsModalLabel">{{ __('foods.complete_payment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="payment-instructions"></div>
                <p class="mt-3 text-muted small">{{ __('foods.payment_simulation') }}</p>
                <form action="{{ route('checkout.confirm') }}" method="POST" id="confirmPaymentForm" class="mt-4">
                    @csrf
                    <input type="hidden" name="payment_method_final" id="payment_method_final">
                    <button type="submit" class="btn btn-primary w-100">{{ __('foods.confirm_payment') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Logic for 'Add Notes' Modal
    const addNoteModalEl = document.getElementById('addNoteModal');
    if(addNoteModalEl) {
        addNoteModalEl.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const cartId = button.getAttribute('data-cart-id');
            const currentNote = button.getAttribute('data-note') || '';
            const noteForm = document.getElementById('addNoteForm');
            const noteTextarea = document.getElementById('noteTextarea');
            if (noteForm && noteTextarea) {
                noteForm.setAttribute('action', `/cart/note/${cartId}`);
                noteTextarea.value = currentNote;
            }
        });
    }

    //Logic for Checkout Modals
    const proceedBtn = document.getElementById('proceedToPaymentBtn');
    const checkoutModalEl = document.getElementById('checkoutModal');
    const paymentDetailsModalEl = document.getElementById('paymentDetailsModal');
    
    if (proceedBtn && checkoutModalEl && paymentDetailsModalEl) {
        const checkoutModal = new bootstrap.Modal(checkoutModalEl);
        const paymentDetailsModal = new bootstrap.Modal(paymentDetailsModalEl);

        let isProceeding = false; 

        proceedBtn.addEventListener('click', function() {
            isProceeding = true;
            checkoutModal.hide();
        });

        checkoutModalEl.addEventListener('hidden.bs.modal', function () {
            if (isProceeding) {
                const selectedPayment = document.querySelector('input[name="paymentMethod"]:checked').value;
                const paymentInstructionsDiv = document.getElementById('payment-instructions');
                const finalPaymentMethodInput = document.getElementById('payment_method_final');
                let instructionsHTML = '';

                if (selectedPayment === 'bca_va') {
                    const vaNumber = '88088' + Math.floor(1000000000 + Math.random() * 9000000000);
                    instructionsHTML = `
                        <h5>${paymentTranslations.bca_va_title}</h5>
                        <p>${paymentTranslations.bca_va_instruction}</p>
                        <h3 class="font-weight-bold">${vaNumber}</h3>
                        <p>${paymentTranslations.bca_va_beneficiary}</p>
                    `;
                    finalPaymentMethodInput.value = paymentTranslations.bca_va_title;
                } else if (selectedPayment === 'qris') {
                    instructionsHTML = `
                        <h5>${paymentTranslations.qris_title}</h5>
                        <p>${paymentTranslations.qris_instruction}</p>
                        <img src="{{ asset('assets/payment_gateway_images/sample_qris.jpg') }}" alt="Sample QRIS" class="img-fluid" style="max-width: 250px; display: block; margin-left: auto; margin-right: auto;">
                    `;
                    finalPaymentMethodInput.value = paymentTranslations.qris_title;
                }
                
                paymentInstructionsDiv.innerHTML = instructionsHTML;
                paymentDetailsModal.show();
                isProceeding = false;
            }
        });
    }
});
</script>
@endpush