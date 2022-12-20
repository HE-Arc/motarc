<template>
<div class="row justify-center items-center">
    <div class="col-md-7 col-xs-12">
        <h2>My ads</h2>

        <!-- If no ads, print message -->
        <div v-if="ads.data.length === 0" class="row justify-center items-center ">
            <q-card class="col-12 q-pa-md bg-grey-1">
                <q-card-section class="q-gutter-md flex flex-center">
                    <div class="column flex flex-center">
                        <!-- Grey title -->
                        <h4 class="text-grey-8 q-ma-sm">You don't have any ads yet :(</h4>

                        <img class="q-ma-sm" src="/storage/images/moto_empty.png" width="200" />

                        <Link href="/ads/create">
                            <q-btn class="q-ma-sm col-12" color="primary">Create an ad</q-btn>
                        </Link>
                    </div>
                </q-card-section>
            </q-card>
        </div>
        <div v-else>

        <q-card v-for="ad in ads.data" :key="ad.id" class="q-my-sm">
            <q-card-section horizontal>
                <img class="col-4" fit="cover" v-if="ad.images[0] !== undefined" :src="'/storage/images/' + ad.images[0].image_url" />
                <img class="col-4" fit="cover" v-else  src="/storage/images/moto_base.png" />

                <!-- Image keeping ratio -->
                <!-- <img v-if="ad.images[0] !== undefined" fit="contain" class="col-5" :src="'/storage/images/' + ad.images[0].image_url" />-->

                <q-card-section>
                <div class="col-8">

                    <h3 class="q-my-md">{{ ad.model.brand + " " + ad.model.model }}</h3>

                <!--<div class="row-items">-->
                    <div class="row q-my-md">
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
                    <!-- Delete ad button that opens a popup -->
                    <q-btn class="q-my-md" color="negative" icon="delete" @click="deletePopup = true">Delete</q-btn>

                    <!-- Delete popup -->
                    <q-dialog v-model="deletePopup" persistent>
                        <q-card>
                            <q-card-section class="row items-center">
                                <span class="q-ml-sm">Are you sure you want to delete this ad?</span>
                            </q-card-section>

                            <q-card-actions align="right">
                                <q-btn flat label="Cancel" color="primary" v-close-popup />
                                <q-btn label="Delete" color="negative" v-close-popup @click="deleteAd(ad.id)" />
                            </q-card-actions>
                        </q-card>
                    </q-dialog>

                </div>
                </q-card-section>
            </q-card-section>
        </q-card>

        <div class="q-pa-lg flex flex-center">
            <q-pagination v-model="current" direction-links boundary-links :max="ads.last_page" />
        </div>
    </div>
    </div>
</div>
</template>

<script>

import { Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { reactive, ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '../../Components/Pagination.vue'

export default {
    layout : AppLayout,
    name: 'My ads',

    components: {
        Pagination,
        Link,
    },

    props: {
        ads: Array,
    },
    data() {
        return {
            current : this.ads.current_page,
            deletePopup : false,
        }
    },
    methods: {
        modifyAd(id) {
            console.log(id)
            this.$inertia.get('/ads/' + id + '/edit');
        },
        deleteAd(id) {
            console.log(id)
            this.$inertia.delete('/ads/' + id);
        }
    },
    // tigger on pagination change
    watch: {
        current : function (val) {
            console.log('watch')
            console.log(val)
            this.$inertia.get('/ads/myads?page=' + val);
        }
    }
}

</script>

<style>

</style>
