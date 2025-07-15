@props([
    'item'
])

<div class="cart-item">
    <img src="{{ asset($item->food->image_url ?? 'storage/food_images/arts_cafe/chocolate_fondant.jpg') }}" alt="{{ $item->food->name }}" class="item-image"/>
    
    <div class="cart-item-details">
        <div class="item-description">
            <div>
                <p class="item-title" style="color: #234C4C">{{ $item->food->name }}</p>
                <p class="item-price my-2" style="color: #234C4C">Price : <strong>IDR {{ number_format($item->food->price, 0, ',', '.') }}</strong></p>
                <p class="item-expiry my-2" style="color: #234C4C">
                    Best Before : <strong>{{ $item->food->exp_datetime ? \Carbon\Carbon::parse($item->food->exp_datetime)->format('d M Y h:m') : 'N/A' }}</strong>
                </p>
            </div>
        </div>
        {{-- show notes jika ada --}}
        @if($item->notes)
            <p class="item-note my-2" style="color: #c55b39; font-style: italic;">
                <strong>Note:</strong> {{ $item->notes }}
            </p>
        @endif

        {{-- note and qty button --}}
        <div class="notes-and-qty-section">
            <button class="add-notes-btn d-flex {{ $item->notes ? 'btn-note-active' : '' }}" 
                    data-bs-toggle="modal" 
                    data-bs-target="#addNoteModal" 
                    data-cart-id="{{ $item->id }}" 
                    data-note="{{ $item->notes }}">
                <img src="{{ asset('assets/add_notes.png') }}" alt="Add" class="add-notes-icon">
                <p style="color:white" class="my-0">Notes</p>
            </button>
            
            <div class="manage-quantity d-flex">
                <form action="{{ route('decrease.cart', $item->id) }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="qty-button">
                        <img src="{{ asset('assets/subtract_button.png') }}" alt="subtract" class="qty-button-img">
                    </button>
                </form>

                <p class="qty-text mx-2">{{ $item->quantity }}</p>

                <form action="{{ route('increase.cart', $item->id) }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="qty-button">
                        <img src="{{ asset('assets/add_button.png') }}" alt="add" class="qty-button-img">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>