<template>
<div class="row justify-center items-center">
    <div class="col-md-7 col-xs-12">
        <h2>My favourites</h2>

        <!-- Display message if no favourites -->
        <div v-if="favourites.data.length==0" class="row justify-center items-center ">
            <q-card class="col-12 q-pa-md bg-grey-1">
                <q-card-section class="q-gutter-md flex flex-center">
                    <div class="column flex flex-center">
                        <h4 class="text-grey-8 q-ma-sm">You don't have any favourite yet :(</h4>
                        <img class="q-ma-sm" src="/storage/images/moto_empty.png" width="200" />
                        <Link href="/ads">
                            <q-btn class="q-ma-sm col-12" color="primary">Search ads</q-btn>
                        </Link>
                    </div>
                </q-card-section>
            </q-card>
        </div>
        <div v-else>
            <!-- Display favourites -->
            <q-card v-for="fav in favourites.data" :key="fav.id" class="q-my-md">
                <q-card-section horizontal>
                    <!-- Display image if exists -->
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
                            <!-- Show ad button -->
                            <Link :href="'/ads/'+ fav.id">
                                <q-btn class="q-mt-md" color="primary">Show</q-btn>
                            </Link>
                            <!-- Remove favourite button -->
                            <q-btn class="q-mt-md" color="white" text-color="primary" icon="star" flat round @click="removeFavourite(fav.id)"></q-btn>
                        </div>
                    </q-card-section>
                </q-card-section>
            </q-card>
            <!--Pagination component-->
            <div class="q-pa-lg flex flex-center">
                <q-pagination v-model="current" direction-links boundary-links :max="favourites.last_page" />
            </div>
        </div>
    </div>
</div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3'

export default {
    layout : AppLayout,
    name: 'My favourites',
    props: {
        ads: Object,
        favourites: Object,
    },
    components: {
        Link,
    },
    methods: {
        removeFavourite(id) {
            for(let i = 0; i < this.favourites.data.length; i++) {
                if(this.favourites.data[i].id == id) {
                    this.$inertia.delete('/favourites/' + this.favourites.data[i].pivot.id, {
                        preserveScroll: true,
                        preserveState: true,
                    })
                }
            }
        },
    },
    data() {
        return {
            current: this.favourites.current_page,
        }
    },
    watch: {
        current: function (val) {
            this.$inertia.get('/favourites?page=' + val);
        }
    },
    updated() {
        console.log("updated");
        // if no favourites, an current page is greater than 1, then go to previous page
        if(this.favourites.data.length == 0 && this.favourites.current_page > 1) {
            this.current = this.favourites.current_page - 1;
        }
    },
}
</script>

<style>

</style>
