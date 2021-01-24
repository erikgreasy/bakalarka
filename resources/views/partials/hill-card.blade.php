<a href="/hills/{{ $hill->id }}">
    <article class="hill">
        <div class="image"></div>
        <div>

            <h4>

                {{ $hill->name }}
            </h4>
            <p>
                {{ $hill->height }} m.n.m.
            </p>
            <p class="description">
                {{ $hill->description }}
            </p>
        </div>
        
    </article>
</a>