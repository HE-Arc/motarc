<template>
<div class="row justify-center items-center">
    <div class="col-md-7 col-xs-12">
        <!-- Back button -->
        <Link :href="'/ads/'+params">
            <q-btn icon="arrow_back" flat round dense></q-btn>
        </Link>
        <q-card class="q-ma-md q-px-md">
            <q-carousel class="q-py-md" swipeable animated v-model="slide" thumbnails infinite v-if="ad.images[0] !== undefined">
                <q-carousel-slide v-for="(image, index) in ad.images" :key="index" :name="index" :img-src="'/public/storage/images/' + image.image_url" />
            </q-carousel>
            <q-carousel swipeable animated v-model="slide" thumbnails infinite v-else>
                <q-carousel-slide :key="0" :name="0" img-src="/public/storage/images/moto_base.png" />
            </q-carousel>

            <q-card-section>
                <h3 class="q-my-sm">{{ ad.model.brand + " " + ad.model.model }}</h3>
                <h4 class="q-my-md">{{ad.price}}.-</h4>

                <q-separator />

                <h5 class="q-my-md">Vehicle data</h5>
                <div class="row">
                    <div class="col">
                        <q-icon name="directions_car" />
                        <p> {{ad.km}} km</p>
                        <q-icon name="" />
                        <p> {{ad.model.capacity}} cm3 </p>
                    </div>
                    <div class="col">
                        <q-icon name="event" />
                        <p> {{ad.model.year}}</p>

                        <q-icon name="color_lens" :color="ad.color" />
                        <p> {{ad.color}}</p>
                    </div>
                    <div class="col">
                        <q-icon name="bolt" />
                        <p> {{ad.power_kw}} kW</p>

                        <q-icon name="category" />
                        <p> {{ad.model.category}} </p>
                    </div>
                </div>

                <q-separator />

                <h5 class="q-my-md">Seller</h5>

                <div class="row">
                    <div class="col">
                        <q-icon name="person" />
                        <p> {{ad.user.name}} </p>
                    </div>
                    <div class="col">
                        <q-icon name="email" />
                        <p> {{ad.user.email}} </p>
                    </div>
                    <div class="col">
                        <q-icon name="location_on" />
                        <p>{{ad.user.npa}}</p>
                    </div>
                </div>
            </q-card-section>
        </q-card>
    </div>
</div>
</template>

<script>
import { ref } from 'vue'
import { Link } from '@inertiajs/inertia-vue3';

import AppLayout from '@/Layouts/AppLayout.vue'
import { SessionStorage } from 'quasar';
import { useMeta } from 'quasar';

const metaData = {
    title: 'Show Ad',
    meta: [
        { name: 'description', content: 'Show Ad' },
        { name: 'keywords', content: 'ad,bike' }
    ]
}

export default {
    layout : AppLayout,
    name: 'Show ad',

    props: {
        ad: Object,
        data: Object,
    },
    data() {
        return {
            params: '',
            page: null,
            scroll: null,
        }
    },

    methods: {
        modifyAd(id) {
            this.$inertia.get('/ads/' + id + '/edit');
        },
        // extract url parameters
        getParams() {
            var p = SessionStorage.getItem('url');
            //var s = SessionStorage.getItem('scroll');
            this.params = p || '';
            var s = SessionStorage.getItem('scroll');

            //console.log(s);
            console.log(p);
            console.log(s);
        },

    },
    setup(){
        useMeta(metaData);
        return {

            slide: ref(0),
        }
    },
    components: {
        Link,
    },
    mounted() {
        this.getParams();
    }

}

</script>

<style>

a {
    text-decoration: none;
    color: black;
}

</style>
