<template>
    <section class="users-ranklist">
        <div class="section-heading">

            <h2>Rebríček dobrodruhov</h2>
            <router-link to="/users">Zobraziť všetky</router-link>
        </div>
        <div class="users">
            <slick ref="slick" :options="slickOptions">
                <div>
                    <router-link v-if="most_distance" :to="'/user/' + most_distance.id">

                        <article class="user">
                            <img :src="most_distance.avatar_path">
                            <h4>
                                {{ most_distance.name }}
                            </h4>
                            <p>Najviac nachodených kilometrov.</p>
                        </article>
                    </router-link>
                    </div>
                <div>
                    <router-link v-if="most_trips" :to="'/user/' + most_trips.id">

                        <article class="user">
                            <img :src="most_trips.avatar_path">
                            <h4>
                                {{ most_trips.name }}
                            </h4>
                            <p>Najviac absolvovaných dobrodružstiev.</p>
                        </article>
                    </router-link>
                </div>
                <div>
                    <router-link v-if="most_time" :to="'/user/' + most_time.id">

                        <article class="user">
                            <img :src="most_time.avatar_path">
                            <h4>
                                {{ most_time.name }}
                            </h4>
                            <p>Najviac času stráveného na horách.</p>
                        </article>
                    </router-link>
                </div>
            </slick>
<!-- 
            <a href="/users/{{ $most_trips->id }}">

                <article class="user">
                    <img src="{{ $most_trips->avatar_path }}" alt="">
                    <h4>
                        {{ $most_trips->name }}
                    </h4>
                    <p>Najviac absolvovaných dobrodružstiev.</p>
                </article>
            </a>

            <a href="/users/{{ $most_time->id }}">

                <article class="user">
                    <img src="{{ $most_time->avatar_path }}" alt="">
                    <h4>
                        {{ $most_time->name }}
                    </h4>
                    <p>Najviac času stráveného na horách.</p>
                </article>
            </a> -->
        </div>
    </section>
</template>

<script>
import 'slick-carousel/slick/slick.css';
import Slick from 'vue-slick';

export default {
    props: ['most_distance', 'most_time', 'most_trips'],

    components: {
        Slick
    },

    data() {
        return {
            slickOptions: {
                slidesToShow: 2.5,
                arrows: false,
                infinite: false,
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    
                ]
            }
        }
    }
}
</script>