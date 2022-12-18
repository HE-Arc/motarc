<template>

    <!-- If no results, print error message -->
    <div v-if="ads.length == 0 || ads == null">
        <p>No results corresponding to your research :( </p>
    </div>

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
                            :max="10000"
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


        <div class="col-9">
        <q-card v-for="ad in ads" :key="ad.id">
            <q-card-section>
                <div class="row">
                    <div class="col-5">
                        <img v-if="ad.images[0] !== undefined" :src="'/storage/images/' + ad.images[0].image_url" width="200" />
                    </div>
                    <div class="col-7">
                        <h3>{{ ad.model.brand + " " + ad.model.model }}</h3>

                        <div class="row">
                            <q-item-label caption>{{ ad.km }} km | {{ad.model.year}} | {{ad.power_kw}} kw</q-item-label>
                        </div>
                            <h4>{{ad.price}} .-</h4>
                            <Link :href="'/ads/'+ ad.id">
                                <q-btn class="q-mt-md" color="primary" label="Show">
                                </q-btn>
                            </Link>

                            <!-- if ad is in favourite, add button with icon -->
                            <q-btn v-if="isInFavourites(ad.id)" class="q-mt-md" color="white" text-color="primary" icon="star" flat round @click="removeFavourite(ad.id)"></q-btn>
                            <!-- if ad is not in favourite, add button with icon -->
                            <q-btn v-else class="q-mt-md"  text-color="black" color="white" icon="star_border" flat round @click="addFavourite(ad.id)"></q-btn>

                    </div>
                </div>
            </q-card-section>
        </q-card>
        </div>
    </div>

</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout : AppLayout,
    name: 'Index ad',
    setup(){
        const form = useForm({
            brand: null,
            model: null,
            price: ref({
                min: 2000,
                max: 5000
            }),
            year: ref({
                min: 2018,
                max: 2022
            }),
            km: ref({
                min: 0,
                max: 20000,
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
        })
        return { form }
    },
    props: {
        ads: Object,
        favourites: Object,
        bikeModels: Array,
    },
    components: {
        Link,
    },
    mounted() {
        this.bikeModels.forEach(element => {
            if (!this.brands.includes(element.brand)){
                this.brands.push(element.brand);
            }
        });
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
            });
        },
        removeFavourite(id) {
            for(let i = 0; i < this.favourites.length; i++) {
                if(this.favourites[i].id == id) {
                    console.log(this.favourites[i].pivot.id)
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
            const colorValues = this.form.color.map((color) => color.value);
            console.log(colorValues);

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
            });
        },
    }
}
</script>
