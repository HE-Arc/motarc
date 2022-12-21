<template>
    <div class="col-grow q-ma-md">
        <h2 class="card-header" id="title404">404 Page not found</h2>

        <div class="card-body">
            <div class="text-h6 q-mb-md">This page does not exist.</div>

            <Link href="/">
                <q-btn color="primary">
                    Go to home page
                </q-btn>
            </Link>

        </div>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3';
import { useMeta } from 'quasar'

const metaData = {
    title: 'Error 404',
    meta: [
        { name: 'description', content: 'Error 404 page' },
        { name: 'keywords', content: 'error, 404' }
    ]
}

export default {
    layout : AppLayout,
    name: '404 : Page not found',

    components: {
        Link
    },
    setup() {
        useMeta(metaData)
    }
}
</script>

<style lang="scss">

#title404 {
    color: $primary;
}

</style>
