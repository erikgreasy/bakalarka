<template>
    <div class="statistics-tabs">
        <div class="tab">
            <!-- <h5>{{ $hill->height }}</h5> -->
            <h5>{{ data[0] }}</h5>

            <p>nachodených kilometrov</p>
        </div>
        <div class="tab">
            <!-- <h5>{{ count( $hill->trips ) }}</h5> -->
            <h5>{{ data[1] }}</h5>
            <p>dobrodružstiev</p>
        </div>
        <div class="tab">
            <h5>{{ (data[2]/3600).toFixed(2) }}</h5>
            <p>Hodín na horách</p>
        </div>
    </div>
</template>


<script>
export default {
    props: [
        'data'
    ]
}
</script>