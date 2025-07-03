@props(['orderStatuses'])

<div class="activity-list">
    @foreach ($orderStatuses as $index => $orderData)
        <div class="card activity-main-item mb-2" id="card-detail">
            <div class="card-header activity-header d-flex align-items-center justify-content-between">
                <div class="card-header-content d-flex align-items-center flex-row">
                    <div class="d-flex flex-column me-3 activity-item-date">
                        <span class="fw-bold" style="color: black;">{{ $orderData['orderPlacedLabel'] ?? 'ORDER PLACED' }}</span>
                        <small class="fw-semi-bold">{{ $orderData['orderPlacedDate'] ?? '25 May 2025' }}</small>
                    </div>
                    <div class="d-flex flex-column me-3 activity-item-total">
                        <span class="fw-bold" style="color: black;">TOTAL</span>
                        <span class="fw-semi-bold">{{ $orderData['total'] ?? 'IDR 50.000,00' }}</span>
                    </div>
                    <div class="d-flex flex-column flex-grow-1 me-3 activity-item-location">
                        <span class="fw-bold" style="color: black;">PICK UP LOCATION</span>
                        <div class="d-flex gap-5">
                            <span class="fw-normal resto-name">{{ $orderData['restoName'] ?? 'Restoran Ny. Nita' }}</span>
                            <span class="fw-normal resto-location">({{ $orderData['restoLocation'] ?? 'Jl. Pakuan No.3, Sumur Batu, Babakan Madang, Bogor' }})</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center activity-item-actions">
                    <div class="btn btn-sm px-3 btn-ready-pickup">{{ $orderData['readyPickupText'] ?? 'Ready to Pick Up' }}</div>
                    <button class="btn btn-sm px-3 food-item-dropdown-toggle" type="button"
                            data-bs-toggle="collapse" data-bs-target="#detailsCollapseFood{{ $index }}"
                            aria-expanded="false" aria-controls="detailsCollapseFood{{ $index }}">
                        See Details
                    </button>
                </div>
            </div>

            <div class="collapse" id="detailsCollapseFood{{ $index }}">
                <div class="card-body details-section p-4">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="order-items ">
                                <p class="details-title">DETAILS:</p>
                                @foreach ($orderData['items'] ?? [] as $item)
                                    <div class="row mb-1">
                                        <div class="col-5">{{ $item['name'] }}</div>
                                        <div class="col-2 text-center">x{{ $item['qty'] }}</div>
                                        <div class="col-5 text-end">{{ $item['price'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-12 col-md-8 col-lg-6 mb-2 mb-md-0">
                            <div class="order-status-timeline-container d-flex justify-content-between align-items-center">
                                @php
                                    $statuses = [
                                        'Order Created' => 'order_created',
                                        'Order Accepted' => 'order_accepted',
                                        'In Progress' => 'in_progress',
                                        'Ready to Pickup' => 'ready_to_pickup',
                                        'Order Completed' => 'order_completed',
                                        'Review Order' => 'review_order'
                                    ];
                                    $currentStatusFound = false;
                                @endphp
                                @foreach ($statuses as $label => $key)
                                    @php
                                        $isActive = false;
                                        if ($orderData['status'] == $key) {
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

                         <div class="col-12 col-xl-2  align-items-end">
                            <button type="button" class="btn review-order-btn px-5 py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $index }}">
                                {{ $orderData['reviewButtonText'] ?? 'Review Order' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="modal fade" id="reviewModal{{ $index }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $index }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom-review-modal">
                    
                    <div class="modal-header border-0 d-flex justify-content-end">
                        <button type="button" class="btn p-0 ms-auto" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none;">
                            <i class="bi bi-x-lg text-white fs-4"></i>
                        </button>
                    </div>

                    <div class="modal-body text-center">
                        <h5 class="mb-3" style="font-family: 'Lato'">How Was Your Food?</h5>

                        <div class="star-rating mb-3">
                            @for ($i = 5; $i >= 1; $i--)
                                <i class="fa fa-star star star-icon" data-rating="{{ $i }}"></i>
                            @endfor
                        </div>

                        <textarea class="form-control comment-box mb-3" rows="3" placeholder="Write your comments here..." style="font-family: 'Lato'"></textarea>

                        <button type="button" class="btn submit px-4 rounded-pill">Submit</button>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
</div>
    