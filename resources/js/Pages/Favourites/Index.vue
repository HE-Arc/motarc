<template>
<div class="row justify-center items-center">
    <div class="col-7">
    <h2>My favourites</h2>

    <div v-if="favourites.length==0">
        <p>You have no favourites yet</p>
    </div>

    <q-card v-for="fav in favourites" :key="fav.id" class="q-my-md">
        <q-card-section horizontal>

            <img class="col-4" fit="cover" v-if="fav.images[0] !== undefined" :src="'/storage/images/' + fav.images[0].image_url" />
            <img class="col-4" fit="cover" v-else  src="/storage/images/moto_base.png" />

            <q-card-section>
                <div class="col-8">

                <h3 class="q-my-md">{{ fav.model.brand + " " + fav.model.model }}</h3>

                <div class="row q-my-sm">
                    <p class="text-grey-8 q-mr-md">{{ fav.km }} km </p>
                        <q-icon color="grey-8" name="event" />
                        <p class="text-grey-8 q-mr-md"> {{ fav.model.year }} </p>
                        <q-icon color="grey-8" name="bolt"></q-icon>
                        <p class="text-grey-8 ">{{ fav.power_kw }} kw </p>
                </div>

                <h4 class="q-my-sm">{{fav.price}}.-</h4>

                <Link :href="'/ads/'+ fav.id">
                <q-btn class="q-mt-md" color="primary">Show</q-btn>
                </Link>
                <q-btn class="q-mt-md" color="white" text-color="primary" icon="star" flat round @click="removeFavourite(fav.id)"></q-btn>

            </div>
            </q-card-section>


        </q-card-section>
    </q-card>

    <div class="q-pa-lg flex flex-center">
        <q-pagination v-model="current" :max="max" input />
    </div>

    </div>
</div>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3'
import ListAds from '../../Components/ListAds.vue';

export default {
    layout : AppLayout,
    name: 'My favourites',
    props: {
        ads: Object,
        favourites: Object,
    },
    components: {
        Link,
        ListAds
    },
    methods: {
        removeFavourite(id) {
            for(let i = 0; i < this.favourites.length; i++) {
                if(this.favourites[i].id == id) {
                    console.log(this.favourites[i].pivot.id)
                    this.$inertia.delete('/favourites/' + this.favourites[i].pivot.id, {
                        preserveScroll: true,
                    });
                }
            }
        },
    },
    data() {
        return {
            current: 1,
            max: 5,
        }
    },
}

</script>

<style>

</style>
