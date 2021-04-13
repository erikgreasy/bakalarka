<template>
    <div>
        <div class="floating-btn" @click="open">
            <i class="fas fa-th"></i>
        </div>
        <ul class="floating-btn-options">
            <li>Link1</li>
            <li>Link2</li>
        </ul>
    </div>
</template>

<script>
export default {

    methods: {
        open() {
            alert('open')
        }
    }
    
}
</script>