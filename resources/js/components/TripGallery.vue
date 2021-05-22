<template>
    <div class="trip-images">
        <slick ref="slick" :options="slickOptions">
            <img v-for="img in images" :key="img.id" :src="img.path" class="gallery-img" />
        </slick>  
    </div>
</template>

<script>
import 'slick-carousel/slick/slick.css';
import Slick from 'vue-slick';

export default {
    components: {
        Slick
    },

    props: ['images'],

    data() {
        return {
            slickOptions: {
                slidesToShow: 1.5,
                infinite: false,
                arrows: false
            }
        }
    }
}
</script>