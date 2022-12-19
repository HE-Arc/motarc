<template>
<div class="row justify-center items-center">
    <div class="col-7">
        <h2>My ads</h2>

        <!-- If no ads, print message -->
        <div v-if="ads.length === 0">
            <p>You have no ads yet :(</p>
        </div>

        <q-card v-for="ad in ads" :key="ad.id" class="q-my-sm">
            <q-card-section horizontal>
                <img  v-if="ad.images[0] !== undefined" fit="fill" class="col-5" :src="'/storage/images/' + ad.images[0].image_url" />
                <img v-else class="col-4" fit="fill" src="/storage/images/moto_base.png" />

                <q-card-section>
                <div class="col-8">

                    <h3 class="q-my-md">{{ ad.model.brand + " " + ad.model.model }}</h3>

                <!--<div class="row-items">-->
                    <div class="row q-my-sm">
                        <!-- Grey text -->
                        <p class="text-grey-8 q-mr-md">{{ ad.km }} km </p>
                        <q-icon color="grey-8" name="event" />
                        <p class="text-grey-8 q-mr-md"> {{ ad.model.year }} </p>
                        <q-icon color="grey-8" name="bolt"></q-icon>
                        <p class="text-grey-8 ">{{ ad.power_kw }} kw </p>
                    </div>

                    <h4 class="q-my-sm">{{ad.price}}.-</h4>

                <!-- Button modify -->
                    <q-btn class="q-my-md" color="primary" icon="edit" @click="modifyAd(ad.id)">Edit</q-btn>
                <!--</div>-->
                </div>
                </q-card-section>
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
