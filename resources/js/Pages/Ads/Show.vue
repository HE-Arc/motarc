<template>
    <h1>Show ad</h1>
    <q-card>
        <q-card-section>
            <img v-if="ad.images[0] !== undefined" :src="'/storage/images/' + ad.images[0].image_url" width="200" />

            <h3>{{ ad.model.brand + " " + ad.model.model }}</h3>

            <div class="row-items">
                <q-item-label caption class="text-weight-bold"> Price </q-item-label>
                <q-item-label caption>{{ ad.price }}</q-item-label>
                <q-item-label caption class="text-weight-bold"> KM </q-item-label>
                <q-item-label caption>{{ ad.km }}</q-item-label>
                <q-item-label caption class="text-weight-bold"> Year </q-item-label>
                <q-item-label caption>{{ ad.model.year }}</q-item-label>

                <q-item-label caption class="text-weight-bold"> Color </q-item-label>
                <q-item-label caption>{{ ad.color_hexa }}</q-item-label>

            <!-- Button modify -->
            <q-btn v-if="$page.props.auth.user.id == ad.user.id" class="q-mt-md" color="primary" icon="edit" @click="modifyAd(ad.id)">Edit</q-btn>
            </div>
        </q-card-section>
    </q-card>
</template>

<script>

import { Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

export default {
    layout : AppLayout,
    name: 'Show ad',

    props: {
        ad: Object,
    },

    methods: {
        modifyAd(id) {
            this.$inertia.get('/ads/' + id + '/edit');
        },
    }
}

</script>

<style>

</style>
