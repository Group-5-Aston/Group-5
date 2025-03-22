@props(['type' => 'success', 'message'])

@php
    $alertType = $type === 'error' ? 'danger' : $type;
@endphp

@if ($message)
    <div class="alert alert-{{ $alertType }}" role="alert">
        {{$message}}
    </div>
@endif
