<a href="/hills/{{ $hill->id }}">
    <article class="wishlist-hill-card">
        <img src="{{ asset($hill->thumbnail_path) }}" alt="">

        <div class="info">
            <h4>{{ $hill->name }}</h4>
            <p class="wishlist-mountain">{{ $hill->mountain->name }}</p>
            <p>{{ $hill->height }} m.n.m.</p>
        </div>
    </article>

</a>