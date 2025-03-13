@props(['type' => 'success', 'message'])

@if ($message)
    <div class="alert alert-{{ $type }}" role="alert">
        {{$message}}
    </div>
@endif
