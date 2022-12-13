<template>
    <q-card v-for="ad in ads" :key="ad.id">
        <q-card-section>
            <!-- foreach ad.images -->
            <!-- <q-carousel animated v-model="slide" arrows navigation infinite v-for="image in ad.images" :key="image.id">
                <q-carousel-slide :name="image.id" :img-src="'/storage/images/' + image.image_url" />
            </q-carousel> -->


            <img :src="'/storage/images/' + ad.images[0].image_url" height="200" width="200" />

            <h3>{{ ad.brand + " " + ad.model.model }}</h3>

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
    },
    components: {
        Link
    },
    setup() {
        return {
            slide: ref(1),
        }
    }
}
</script>
