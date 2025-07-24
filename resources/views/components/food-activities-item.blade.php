@props(['orderStatuses'])

@foreach ($orderStatuses as $index => $orderData)
    <div class="card activity-main-item mb-2" id="card-detail">
        <div class="card-header activity-header d-flex align-items-center justify-content-between">
            <div class="card-header-content d-flex align-items-center flex-row">
                <div class="d-flex flex-column me-3 activity-item-date">
                    <span class="fw-bold" style="color: black;">{{ $orderData['orderPlacedLabel'] }}</span>
                    <small class="fw-semi-bold">{{ $orderData['orderPlacedDate'] }}</small>
                </div>
                <div class="d-flex flex-column me-3 activity-item-total">
                    <span class="fw-bold" style="color: black;">TOTAL</span>
                    <span class="fw-semi-bold">{{ $orderData['total'] }}</span>
                </div>
                <div class="d-flex flex-column flex-grow-1 me-3 activity-item-location">
                    <span class="fw-bold" style="color: black;">PICK UP LOCATION</span>
                    <div class="d-flex">
                        <span class="fw-normal resto-name">{{ $orderData['restoName'] }}</span>
                        <span class="fw-normal resto-location">({{ $orderData['restoLocation'] }})</span>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center activity-item-actions gap-2">
                <div class="btn btn-sm px-3 btn-ready-pickup">{{ $orderData['readyPickupText'] }}</div>
                <button class="btn btn-sm px-3 dropdown-toggle" type="button"
                    style="background-color: #FFF2CE; border: 1px solid #063434; border-radius: 12px;"
                    data-bs-toggle="collapse" data-bs-target="#order-card-{{ $orderData['orderId'] }}" aria-expanded="false"
                    aria-controls="order-card-{{ $orderData['orderId'] }}">
                    See Details
                </button>
            </div>
        </div>

        <div class="collapse" id="order-card-{{ $orderData['orderId'] }}">
            <div class="card-body details-section p-4">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="order-items gap-2">
                            <p class="details-title">DETAILS:</p>
                            @foreach ($orderData['items'] as $item)
                                <div class="row mb-1">
                                    <div class="col-5">{{ $item['name'] }}</div>
                                    <div class="col-2 text-center">x{{ $item['qty'] }}</div>
                                    <div class="col-5 text-end">{{ $item['price'] }}</div>
                                    @if (!empty($item['notes']))
                                        <div class="col-12 text-muted ps-2 small">Note: {{ $item['notes'] }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="col-12 col-md-8 col-lg-6 mb-2 mb-md-0">
                        <div class="order-status-timeline-container d-flex justify-content-between align-items-center"
                            style="overflow-y: hidden">
                            @php
                                $statuses = [
                                    'Order Created' => 'order_created',
                                    'Ready to Pickup' => 'ready_to_pickup',
                                    'Order Completed' => 'order_completed',
                                    'Order Reviewed' => 'review_order',
                                ];
                                $currentStatusFound = false;
                            @endphp

                            @foreach ($statuses as $label => $key)
                                @php
                                    $isActive = false;
                                    if ($orderData['status'] === $key) {
                                        $isActive = true;
                                        $currentStatusFound = true;
                                    } elseif (!$currentStatusFound) {
                                        $isActive = true;
                                    }
                                @endphp

                                <div class="timeline-wrapper d-flex flex-wrap justify-content-center gap-3">
                                    <div class="timeline-step text-center {{ $isActive ? 'active-step' : '' }}">
                                        <div class="circle d-flex justify-content-center align-items-center">
                                            <i class="fas fa-check"></i>
                                            <span class="icon-placeholder"></span>
                                        </div>
                                        <p class="status-label d-flex mt-1">{{ $label }}</p>
                                    </div>
                                </div>

                                @if (!$loop->last)
                                    <div class="line {{ $isActive ? 'active-line' : '' }}"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @if(!empty($orderData['reviewButtonText']))
                        <div class="col-12 col-xl-2 align-items-end">
                            <button type="button" class="btn review-order-btn px-5 py-2 rounded-pill" data-bs-toggle="modal"
                                data-bs-target="#reviewModal{{ $orderData['orderId'] }}">
                                {{ $orderData['reviewButtonText'] }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @if(!empty($orderData['reviewButtonText']) && $orderData['reviewButtonText'] === 'Review Order')
        <div class="modal fade" id="reviewModal{{ $orderData['orderId'] }}" tabindex="-1"
            aria-labelledby="reviewModalLabel{{ $orderData['orderId'] }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom-review-modal">
                    <div class="modal-header border-0 d-flex justify-content-end">
                        <button type="button" class="btn p-0 ms-auto" data-bs-dismiss="modal" aria-label="Close"
                            style="background: none; border: none;">
                            <i class="bi bi-x-lg text-white fs-4"></i>
                        </button>
                    </div>

                    <div class="modal-body text-center d-flex flex-column gap-5">
                        <h5 class="mb-3" style="font-family: 'Lato'">How Was Your Food?</h5>
                        <form method="POST" action="{{ route('orders.rate', ['id' => $orderData['orderId']]) }}">
                            @csrf
                            <input type="hidden" name="rating" class="rating-input" value="0">
                            <div class="star-rating mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star star-icon" data-rating="{{ $i }}"></i>
                                @endfor
                            </div>
                            <button type="submit" class="btn submit px-4 rounded-pill">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach