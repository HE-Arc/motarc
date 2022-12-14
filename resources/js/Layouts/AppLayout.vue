<script>
import Header from './Header.vue'
import Footer from './Footer.vue'

export default {
    name: 'AppLayout',
    components: {
        Header,
        Footer
    }
}
</script>

<template>
    <q-layout>
    <Header />
    <slot></slot>
    <!-- <Footer /> -->
    </q-layout>
</template>
