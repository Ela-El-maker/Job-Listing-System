@props(['height', 'width', 'source'])
@if ($source)
    <div>
        <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
        <img {{ $attributes->merge(['style' => "height: {$height}px; width: {$width}px; object-fit: cover; "]) }}
            src="{{ $source }}" alt="">
    </div>
@endif
