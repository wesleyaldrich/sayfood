@props(['id', 'title', 'contentClasses' => ''])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content {{ $contentClasses }}">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ $id }}Label">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                @if (isset($footer))
                    {{ $footer }}
                @else
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                @endif
            </div>
        </div>
    </div>
</div>