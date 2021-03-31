@if( !empty($hills) )
    <section class="my-hills">
        <div class="section-heading">
            <h2>Uložené kopce</h2>

        </div>
        <div class="wishlist-cards">
            @foreach ($hills as $hill)
                @include('partials/wishlist-hill-card')
            @endforeach
        </div>
    </section>
@endif