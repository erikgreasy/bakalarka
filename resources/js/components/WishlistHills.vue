<template>
    <section class="my-hills">
        <div class="section-heading">
            <h2>Uložené kopce</h2>

        </div>
        <div class="wishlist-cards" v-if="wishlist.length">
            <slick ref="slick" :options="slickOptions">
                <wishlist-hill v-for="hill in wishlist" :key="hill.id" :hill="hill"></wishlist-hill>
            </slick>  
        </div>
        <div v-else>
            Zatiaľ žiadne uložené kopce
        </div>
    </section>
</template>

<script>
import Slick from 'vue-slick';
// import 'slick-carousel/slick/slick.css';
import WishlistHill from '../components/WishlistHill.vue';

export default {
    components: {
        Slick,
        WishlistHill
    },
    props: ['wishlist'],
    data() {
        return {
            slickOptions: {
                slidesToShow: 1.5,
                infinite: false,
                arrows: false,
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2.5,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3.5,
                        }
                    }
                ]
            },

        }
    }
    
}
</script>