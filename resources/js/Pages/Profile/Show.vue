<template>
    <q-card>
        <q-card-section>
            <h2>My profile</h2>

            <q-item-label caption class="text-weight-bold"> Name </q-item-label>
            <q-item-label caption>{{ user.name }}</q-item-label>

            <q-item-label caption class="text-weight-bold"> Email </q-item-label>
            <q-item-label caption>{{ user.email }}</q-item-label>

            <q-item-label caption class="text-weight-bold"> NPA </q-item-label>
            <q-item-label caption>{{ user.npa }}</q-item-label>

            <!-- Button modify -->
            <q-btn
                class="q-mt-md"
                color="deep-orange-9"
                to="/profile/edit"
            >
            <Link href="/profile/edit">Modify</Link>
            </q-btn>
        </q-card-section>
    </q-card>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    layout : AppLayout,
    name: 'Show profile',
    props: {
        user: Object,
    },
    components: {
        Link
    },
}

</script>

<style>

</style>
