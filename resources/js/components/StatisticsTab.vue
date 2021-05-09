<template>
    <div class="statistics-tabs">
        <div class="tab">
            <h5 v-if="data.length">{{ data[0].value }}</h5>
            <p>{{ data[0].name }}</p>

        </div>
        <div class="tab">
            <h5 v-if="data.length">{{ data[1].value }}</h5>
            <p>{{ data[1].name }}</p>
        </div>
        <div class="tab">
            <h5 v-if="data.length">{{ data[2].value }}</h5>
            <p>{{ data[2].name }}</p>
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