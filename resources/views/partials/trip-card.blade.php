<a href="/trips/{{ $trip->id }}">
    <article class="card">
        <div class="image">
            {{-- <img src="https://media-cdn.tripadvisor.com/media/photo-s/17/de/62/71/sosodikon-hill.jpg" alt="">
             --}}
            <img src="{{ asset($trip->thumbnail_path) }}" alt="">

        </div>
        <div>

            <h4>

                {{ $trip->title }}
            </h4>
            <p>
                {{ $trip->hill->name }}
            </p>
            <p class="description">
                {{ Str::limit( $trip->description, 80 ) }}
            </p>
        </div>
        
    </article>
</a>