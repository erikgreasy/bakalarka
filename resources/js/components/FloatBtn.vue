<template>
    <div>
        <div class="floating-btn" @click="open">
            <i class="fas fa-th"></i>
        </div>
        <ul class="floating-btn-options">
            <slot>
                
            </slot>
        </ul>
    </div>
</template>

<script>
export default {

    methods: {
        open() {

            const optionsHeight = $( '.floating-btn-options' ).height() - 62
            console.log(optionsHeight)
            $( 'body' ).toggleClass( 'floating-options-opened' )
            $( '.floating-btn-options' ).toggleClass( 'active' )
            
            if( $('body').hasClass('floating-options-opened') ) {
                $( '.floating-btn' ).css({
                    transform: `translateY(-${optionsHeight}px)`
                })
            } else {
                $( '.floating-btn' ).css({
                    transform: `translateY(0)`
                })
            }
        }
    },
    mounted() {
        $( '.floating-btn-options a' ).on('click', function() {
            $( 'body' ).toggleClass( 'floating-options-opened' )

        })

    }
    
}
</script>