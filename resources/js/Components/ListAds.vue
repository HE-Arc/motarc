<template>
    <q-card v-for="ad in ads" :key="ad.id">
        <q-card-section>
            <img v-if="ad.images[0] !== undefined" :src="'/public/storage/images/' + ad.images[0].image_url" width="200" />

            <h3>{{ ad.model.brand + " " + ad.model.model }}</h3>

            <div class="row-items">
                <q-item-label caption class="text-weight-bold"> Price </q-item-label>
                <q-item-label caption>{{ ad.price }}</q-item-label>
                <q-item-label caption class="text-weight-bold"> KM </q-item-label>
                <q-item-label caption>{{ ad.km }}</q-item-label>
                <q-item-label caption class="text-weight-bold"> Year </q-item-label>
                <q-item-label caption>{{ ad.model.year }}</q-item-label>
            <q-btn class="q-mt-md" color="deep-orange-9">
                <Link :href="'/ads/'+ ad.id">Show</Link>
            </q-btn>

            <!-- if ad is in favourite, add button with icon -->
            <q-btn v-if="isInFavourites(ad.id)" class="q-mt-md" color="white" text-color="deep-orange-9" icon="star" flat round @click="removeFavourite(ad.id)"></q-btn>
            <!-- if ad is not in favourite, add button with icon -->
            <q-btn v-else class="q-mt-md"  text-color="black" color="white" icon="star_border" flat round @click="addFavourite(ad.id)"></q-btn>
            </div>
        </q-card-section>
    </q-card>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

export default {
    layout : AppLayout,
    name: 'Index ad',
    props: {
        ads: Object,
        favourites: Object,
    },
    components: {
        Link
    },
    setup() {
        return {
            slide: ref(1),
        }
    },
    methods: {
        addFavourite(id) {
            this.$inertia.post('/favourites', {ad_id: id}, {
                preserveScroll: true,
            });
        },
        removeFavourite(id) {
            for(let i = 0; i < this.favourites.length; i++) {
                if(this.favourites[i].id == id) {
                    this.deleteFavourite(this.favourites[i].pivot.id);
                }
            }
        },
        isInFavourites(id) {
            for (let i = 0; i < this.favourites.length; i++) {
                if (this.favourites[i].id == id) {
                    return true;
                }
            }
            return false;
        },
        deleteFavourite(id) {
            this.$inertia.delete('/favourites/' + id, {
                preserveScroll: true,
            });
        }
    }
}
</script>
