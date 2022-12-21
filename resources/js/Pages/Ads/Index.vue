<template>
    <!-- Left menu to change parameter -->
    <div class="row">
        <div class="col-3">
            <q-card class="q-pa-sm">
                <q-card-section>
                    <form @submit.prevent="submit">
                        <!-- Brand dropdown -->
                        <q-select
                            v-model="form.brand"
                            :options="brands"
                            label="Brand"
                            filled
                            @update:modelValue="getModels()"
                            clearable
                        />
                        <!-- Model dropdown, disabled when no brand selected -->
                        <q-select
                            v-model="form.model"
                            :options="models"
                            label="Model"
                            filled
                            :disable="!form.brand"
                            clearable
                            @update:modelValue="submit()"
                            class="q-mb-sm"
                        />
                        <!-- Label for price range -->
                        <q-label>Price</q-label>
                        <!-- Price range -->
                        <q-range
                            v-model="form.price"
                            suffix="CHF"
                            :min="0"
                            :max="50000"
                            :step="100"
                            label-always
                            color="primary"
                            @change="submit()"
                            class="q-mt-lg"
                        ></q-range>

                        <!-- Label for KM -->
                        <q-label>KM</q-label>
                        <!-- KM range -->
                        <q-range
                            v-model="form.km"
                            filled
                            type="number"
                            suffix="km"
                            :min="0"
                            :max="200000"
                            :step="1000"
                            color="primary"
                            label-always
                            @change="submit()"
                            class="q-mt-lg"
                        ></q-range>
                        <!-- Label for year -->
                        <q-label>Year</q-label>
                        <!-- Year range -->
                        <q-range
                            v-model="form.year"
                            filled
                            type="number"
                            suffix="year"
                            :min="1900"
                            :max="2023"
                            :step="1"
                            color="primary"
                            label-always
                            @change="submit()"
                            class="q-mt-lg"
                        ></q-range>
                        <!-- Label for power -->
                        <q-label>Power</q-label>
                        <!-- Power range -->
                        <q-range
                            v-model="form.power"
                            filled
                            type="number"
                            suffix="kw"
                            :min="0"
                            :max="200"
                            :step="1"
                            color="primary"
                            label-always
                            @change="submit()"
                            class="q-mt-lg"
                        ></q-range>
                        <!-- Label for capacity -->
                        <q-label>Capacity</q-label>
                        <!-- Capacity range -->
                        <q-range
                            v-model="form.capacity"
                            filled
                            type="number"
                            suffix="cc"
                            :min="0"
                            :max="2000"
                            :step="1"
                            color="primary"
                            label-always
                            @change="submit()"
                            class="q-mt-lg"
                        ></q-range>
                        <!-- Color dropdown with color oreview -->
                        <q-select
                            v-model="form.color"
                            :options="colors"
                            label="Color"
                            filled
                            color="primary"
                            option-color
                            option-value="value"
                            option-label="label"
                            clearable
                            @update:modelValue="submit()"
                            multiple
                            use-chips
                        >
                        <template v-slot:option="scope">
                            <q-item v-bind="scope.itemProps" v-on="scope.itemEvents">
                            <q-item-section avatar>
                                <q-icon name="square" :color="scope.opt.value" />
                            </q-item-section>
                            <q-item-section>{{ scope.opt.label }}</q-item-section>
                            </q-item>
                        </template>
                        <template v-slot:selected-item="scope">
                            <q-chip
                             removable
                             @remove="scope.removeAtIndex(scope.index)"
                             :tabIndex="scope.tabIndex"
                             dense
                            >
                            <q-icon name="circle" :color="scope.opt.value" />
                            {{scope.opt.label}}
                            </q-chip>
                        </template>
                    </q-select>
                    </form>
                </q-card-section>
            </q-card>
        </div>

        <div class="col-8 q-ma-xl">
            <div v-if="ads.data.length == 0 || ads.data == null" class="row justify-center items-center ">
                <q-card class="col-12 q-pa-md bg-grey-1">
                    <q-card-section class="q-gutter-md flex flex-center">
                        <div class="column flex flex-center">
                            <h4 class="text-grey-8 q-ma-sm">No ads corresponding to your research :(</h4>
                            <img class="q-ma-sm" src="/public/storage/images/moto_empty.png" width="200" />
                        </div>
                    </q-card-section>
                </q-card>
            </div>
            <div v-else>

        <q-card v-for="ad in ads.data" :key="ad.id" class="q-my-md">
            <q-card-section horizontal>
                <img class="col-4" fit="cover" v-if="ad.images[0] !== undefined" :src="'/public/storage/images/' + ad.images[0].image_url" />
                <img class="col-4" fit="cover" v-else  src="/public/storage/images/moto_base.png" />

                    <q-card-section>
                        <div class="col-8">
                            <h3 class="q-my-md">{{ ad.model.brand + " " + ad.model.model }}</h3>

                            <div class="row q-my-sm">
                                <p class="text-grey-8 q-mr-md">{{ ad.km }} km </p>
                                <q-icon color="grey-8" name="event" />
                                <p class="text-grey-8 q-mr-md"> {{ ad.model.year }} </p>
                                <q-icon color="grey-8" name="bolt"></q-icon>
                                <p class="text-grey-8 ">{{ ad.power_kw }} kw </p>
                            </div>

                            <h4  class="q-my-sm">{{ad.price}} .-</h4>
                            <Link :href="'/ads/'+ ad.id" @click="getUrl(ad.id)">
                                <q-btn class="q-mt-md" color="primary" label="Show"></q-btn>
                            </Link>

                            <!-- if ad is in favourite, add button with icon -->
                            <q-btn v-if="isInFavourites(ad.id)" class="q-mt-md" color="white" text-color="primary" icon="star" flat round @click="removeFavourite(ad.id)"></q-btn>
                            <!-- if ad is not in favourite, add button with icon -->
                            <q-btn v-else class="q-mt-md"  text-color="black" color="white" icon="star_border" flat round @click="addFavourite(ad.id)"></q-btn>
                        </div>
                    </q-card-section>
                </q-card-section>
            </q-card>

            <div class="q-pa-lg flex flex-center">
                <Pagination :paginate="ads" :params="params" />
            </div>
        </div>
    </div>
</div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import Pagination from '../../Components/Pagination.vue'
import { scroll } from 'quasar';
import {useMeta} from 'quasar';

const {getVerticalScrollPosition, setVerticalScrollPosition} = scroll;

const metaData = {
    title: 'Ads',
    meta: [
        { name: 'description', content: 'Ads search result' },
        { name: 'keywords', content: 'Ads, search, results, bike' },
    ]
}

export default {
    layout : AppLayout,
    name: 'Index ad',

    setup(props){
        useMeta(metaData);
        const form = useForm({
            brand: null,
            model: null,
            price: ref({
                min: 0,
                max: 50000
            }),
            year: ref({
                min: 1900,
                max: 2023
            }),
            km: ref({
                min: 0,
                max: 200000,
            }),
            power: ref({
                min: 0,
                max: 200,
            }),
            capacity: ref({
                min: 0,
                max: 2000,
            }),
            color: ref([]),
        });
        return { form }
    },

    props: {
        ads: Object,
        favourites: Object,
        bikeModels: Array,
    },

    components: {
        Link,
        Pagination
    },

    mounted() {
        console.log("mounted");
        this.updateParams();

        this.bikeModels.forEach(element => {
            if (!this.brands.includes(element.brand)){
                this.brands.push(element.brand);
            }
        });
    },
    updated() {
        //console.log("updated");
        //this.updateParams();
    },
    data() {
        return {
            brands: [],
            models: [],
            colors: [
                { label: 'Yellow', value: 'yellow' },
                { label: 'Orange', value: 'orange' },
                { label: 'Red', value: 'red' },
                { label: 'Pink', value: 'pink' },
                { label: 'Purple', value: 'purple' },
                { label: 'Blue', value: 'blue' },
                { label: 'Green', value: 'green' },
                { label: 'Brown', value: 'brown' },
                { label: 'Grey', value: 'grey' },
                { label: 'Black', value: 'black' },
                { label: 'White', value: 'white' },
            ],
            params: [],
            current: this.ads.current_page,
            isFromSearch: false,
            lastMaxPage: this.ads.last_page,
            lastPage: 1,
        }
    },
    methods: {
        getModels() {
            this.form.model = null;
            this.models = [];
            this.bikeModels.forEach(element => {
                if (element.brand == this.form.brand  && !this.models.includes(element.model)){
                    this.models.push(element.model);
                }
            });
            this.submit();
        },

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
            if (this.favourites !== undefined){
                for (let i = 0; i < this.favourites.length; i++) {
                    if (this.favourites[i].id == id) {
                        return true;
                    }
                }
            }
            return false;
        },

        deleteFavourite(id) {
            this.$inertia.delete('/favourites/' + id, {
                preserveScroll: true,
            });
        },

        submit() {
            this.isFromSearch = true;

            var colorValues = undefined;
            if(this.form.color !== null)
                colorValues = this.form.color.map((color) => color.value);

            this.form.transform((data) => ({
                ...data,
                minprice : data.price.min,
                maxprice : data.price.max,
                minyear : data.year.min,
                maxyear : data.year.max,
                minkm : data.km.min,
                maxkm : data.km.max,
                minprice : data.price.min,
                maxprice : data.price.max,
                minpower_kw : data.power.min,
                maxpower_kw : data.power.max,
                mincapacity : data.capacity.min,
                maxcapacity : data.capacity.max,
                price: undefined,
                year: undefined,
                km: undefined,
                power: undefined,
                capacity: undefined,
                model: data.model || undefined,
                brand: data.brand || undefined,
                color: colorValues || undefined,
            })).get('/ads', {
                preserveState: true,
                preserveScroll: true,
                only: ['ads'],
            }).then(() => {
                this.updateParams();
                this.isFromSearch = false;
            });
            this.isFromSearch = false;
            this.current = 0;
        },

        updateParams()
        {
            this.params = window.location.search;

            // If the string contains 'page'
            if (this.params.includes('page')) {
                // Get the index of the first &
                let index = this.params.indexOf('&');

                this.params = this.params.substring(index + 1, this.params.length);
            }

            // If the string start with a '?', remove it
            if (this.params.startsWith('?')) {
                this.params = this.params.substring(1, this.params.length);
            }

            // extract the params and fill the form with them
            let params = this.params.split('&');
            this.form.color = [];

            params.forEach(element => {
                let param = element.split('=');

                if (param[0] == 'brand') {
                    this.form.brand = param[1];
                }
                if (param[0] == 'model') {
                    this.form.model = param[1];
                }
                if (param[0] == 'minprice') {
                    this.form.price.min = param[1];
                }
                if (param[0] == 'maxprice') {
                    this.form.price.max = param[1];
                }
                if (param[0] == 'minyear') {
                    this.form.year.min = param[1];
                }
                if (param[0] == 'maxyear') {
                    this.form.year.max = param[1];
                }
                if (param[0] == 'minkm') {
                    this.form.km.min = param[1];
                }
                if (param[0] == 'maxkm') {
                    this.form.km.max = param[1];
                }
                if (param[0] == 'minpower_kw') {
                    this.form.power.min = param[1];
                }
                if (param[0] == 'maxpower_kw') {
                    this.form.power.max = param[1];
                }
                if (param[0] == 'mincapacity') {
                    this.form.capacity.min = param[1];
                }
                if (param[0] == 'maxcapacity') {
                    this.form.capacity.max = param[1];
                }
                if (param[0] == 'color[]') {
                    let colors_ = param[1].split(',');
                    colors_ = colors_.map((color) => ({value: color, label: color}))
                    this.form.color.push(colors_[0]);
                    //console.log(this.form.color);
                }
            });

        },
        getUrl(id){
            sessionStorage.setItem('url', window.location.search);

            var scroll_ = document.body.scrollTop || document.documentElement.scrollTop;
            sessionStorage.setItem('scroll', scroll_);
            sessionStorage.setItem('lastAdId', id);
        },
    },

    watch: {
        current: function (val) {
            if (this.isFromSearch) {
                this.isFromSearch = false;

                return;
            }
            this.lastPage = val;

            this.$inertia.get('/ads?page=' + val + '&' + this.params, {
                preserveScroll: true,
            }).then(() => {
                this.updateParams();
            });
        }
    }
}
</script>
