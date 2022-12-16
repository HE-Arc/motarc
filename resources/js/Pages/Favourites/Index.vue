<template>
    <h2>My favourites</h2>

    <div v-if="favourites.length==0">
        <p>You have no favourites yet</p>
    </div>

    <q-card v-for="fav in favourites" :key="fav.id">
        <q-card-section>

            <img v-if="fav.images[0] !== undefined" :src="'/storage/images/' + fav.images[0].image_url" width="200" />

            <h3>{{ fav.model.brand + " " + fav.model.model }}</h3>
            <div class="row-items">
                <q-item-label caption class="text-weight-bold"> Price </q-item-label>
                <q-item-label caption>{{ fav.price }}</q-item-label>
                <q-item-label caption class="text-weight-bold"> KM </q-item-label>
                <q-item-label caption>{{ fav.km }}</q-item-label>
                <q-item-label caption class="text-weight-bold"> Year </q-item-label>
                <q-item-label caption>{{ fav.model.year }}</q-item-label>
            <q-btn class="q-mt-md" color="primary">
                <Link :href="'/ads/'+ fav.id">Show</Link>
            </q-btn>
            </div>


            <q-btn class="q-mt-md" color="white" text-color="primary" icon="star" flat round @click="removeFavourite(fav.id)"></q-btn>
        </q-card-section>
    </q-card>
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
    }
}

</script>

<style>

</style>
