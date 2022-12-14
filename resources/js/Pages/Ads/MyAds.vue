<template>
    <h2>My ads</h2>
    <q-card v-for="ad in ads" :key="ad.id">
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

            <!-- Button modify -->
            <q-btn class="q-mt-md" color="deep-orange-9" icon="edit" @click="modifyAd(ad.id)">Edit</q-btn>
            </div>
        </q-card-section>
    </q-card>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'

export default {
    layout : AppLayout,
    name: 'My ads',
    props: {
        ads: Object,
    },
    methods: {
        modifyAd(id) {
            console.log(id)
            this.$inertia.get('/ads/' + id + '/edit');
        },
    }
}

</script>

<style>

</style>
