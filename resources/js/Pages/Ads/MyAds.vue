<template>
<div class="row justify-center items-center">
    <div class="col-6 ">
        <h2>My ads</h2>

        <!-- If no ads, print message -->
        <div v-if="ads.length === 0">
            <p>You have no ads yet :(</p>
        </div>

        <q-card v-for="ad in ads" :key="ad.id">
            <q-card-section>
                <div class="row">
                <div class="col-6">
                <img v-if="ad.images[0] !== undefined" :src="'/storage/images/' + ad.images[0].image_url" width="200" />
                </div>
                <div class="col-6">
                <h3>{{ ad.model.brand + " " + ad.model.model }}</h3>

                <!--<div class="row-items">-->
                <div class="row">
                    <q-item-label caption class="text-weight-bold"> KM </q-item-label>
                    <q-item-label caption>{{ ad.km }}</q-item-label>
                    <q-item-label caption class="text-weight-bold"> Year </q-item-label>
                    <q-item-label caption>{{ ad.model.year }}</q-item-label>
                </div>

                <h4>{{ad.price}}.-</h4>

                <!-- Button modify -->
                    <q-btn class="q-mt-md" color="primary" icon="edit" @click="modifyAd(ad.id)">Edit</q-btn>
                <!--</div>-->
                </div>
            </div>
            </q-card-section>
        </q-card>
    </div>
</div>
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
