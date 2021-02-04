<section class="my-hills">
    <div class="section-heading">
        <h2>Moje kopce</h2>
        <a href="#">Zobraziť všetky</a>

    </div>
    <div class="wishlist-cards">
        @foreach ($hills as $hill)
            @include('partials/wishlist-hill-card')
        @endforeach
    </div>
</section>