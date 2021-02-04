<a href="/hills/{{ $hill->id }}">
    <article class="card">
        <div class="image">
            <img src="{{ asset($hill->thumbnail_path) }}" alt="">
        </div>
        <div>

            <h4>

                {{ $hill->name }}
            </h4>
            <p>
                {{ $hill->height }} m.n.m.
            </p>
            <p class="description">
                {{ Str::limit( $hill->description, 80 ) }}
            </p>
        </div>
        
    </article>
</a>