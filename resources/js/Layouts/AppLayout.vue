<template>
    <q-layout>
    <Header></Header>
    <q-page-container>
        <q-page>
        <slot></slot>
    </q-page>
    </q-page-container>
    <!-- <Footer /> -->
    </q-layout>
</template>

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


