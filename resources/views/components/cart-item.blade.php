@props([
    'item'
])

<div class="cart-item">
    <img src="{{ asset($item->image_url ?? 'assets/food_images/arts_cafe/chocolate_fondant.jpg') }}" alt="{{ $item->name }}" class="item-image"/>
    
    <div class="cart-item-details">
        <div class="item-description">
            <div>
                <p class="item-title" style="color: #234C4C">{{ $item->name }}</p>
                <p class="item-price my-2" style="color: #234C4C">Price : <strong>IDR {{ number_format($item->price, 0, ',', '.') }}</strong></p>
                <p class="item-expiry my-2" style="color: #234C4C">
                    Best Before : <strong>{{ $item->exp_datetime ? \Carbon\Carbon::parse($item->exp_datetime)->format('d M Y') : 'N/A' }}</strong>
                </p>
            </div>
        </div>
        
        {{-- note and qty button --}}
        <div class="notes-and-qty-section">
            <button class="add-notes-btn d-flex" data-toggle="modal" data-target="#addNoteModal">
                <img src="{{ asset('assets/add_notes.png') }}" alt="Add" class="add-notes-icon">
                <p style="color:white" class="my-0">Notes</p>
            </button>
            
            <div class="manage-quantity d-flex align-items-center">
                <button class="qty-button">
                    <img src="{{ asset('assets/add_button.png') }}" alt="add" class="qty-button-img">
                </button>
                <p class="qty-text">1</p> {{-- masih manual/hardcode --}}
                <button class="qty-button">
                    <img src="{{ asset('assets/subtract_button.png') }}" alt="subtract" class="qty-button-img">
                </button>
            </div>
        </div>
    </div>
</div>