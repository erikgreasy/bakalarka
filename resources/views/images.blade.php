<div>
    {{ $images }}
    @foreach ($images as $image)
        <img src="{{URL('/uploads/' . $image->url)}}" alt="">
        {{ $image->url }}
    @endforeach
</div>