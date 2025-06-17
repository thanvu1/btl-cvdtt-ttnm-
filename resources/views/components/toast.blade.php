@props(['message' => '', 'type' => 'success'])

@php
    $bgClass = match($type) {
        'success' => 'bg-success',
        'error' => 'bg-danger',
        'info' => 'bg-info',
        'warning' => 'bg-warning',
        default => 'bg-secondary'
    };
@endphp

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div class="toast align-items-center text-white {{ $bgClass }} border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ $message }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
