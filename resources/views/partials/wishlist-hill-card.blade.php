<a href="/hills/{{ $hill->id }}">
    <article class="wishlist-hill-card">
        <img src="https://media-cdn.tripadvisor.com/media/photo-s/17/de/62/71/sosodikon-hill.jpg" alt="">
        <div class="info">
            <h4>{{ $hill->name }}</h4>
            <p class="wishlist-mountain">{{ $hill->mountain->name }}</p>
            <p>{{ $hill->height }} m.n.m.</p>
        </div>
    </article>

</a>