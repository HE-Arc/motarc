<template>
    <div class="row justify-center items-center ">
        <div class="col-xs-12 col-md-6 q-mt-xl">
        <q-card>
        <q-card-section>
            <div class="q-px-md">
            <h4>Find your dream motorcycle ✨</h4>
            <form @submit.prevent="submit">
                <!-- brand drop down -->
                <q-select
                    v-model="form.brand"
                    :options="brands"
                    label="Brand"
                    filled
                    @update:modelValue="getModels()"
                />
                <!-- model drop down, disabled when no brand selected -->
                <q-select
                    v-model="form.model"
                    :options="models"
                    label="Model"
                    filled
                    :disable="!form.brand"
                    class="q-mb-sm"
                />

                <!-- Price range -->
                <q-label>Price</q-label>
                <q-range
                    v-model="form.price"
                    suffix="CHF"
                    :min="0"
                    :max="50000"
                    :step="100"
                    label-always
                    color="primary"
                    class="q-mt-lg"
                >
                </q-range>

                <!-- KM range -->
                <q-label>KM</q-label>
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
                    class="q-mt-lg"
                />

                <!-- Year range -->
                <q-label>Year</q-label>
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
                    class="q-mt-lg"
                />

                <!-- Submit button -->
                <q-btn
                    label="Search"
                    type="submit"
                    color="primary"
                    @click="submit"
                    class="q-my-md"
                />
            </form>

            <!-- Advanced search link -->
            <p class="text-blue-grey-4">Want more parameters ? <Link href="/ads" id="adv-search">
                Advanced search
            </Link></p>
        </div>
        </q-card-section>
    </q-card>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import { useMeta } from 'quasar';

const metaData = {
    title: 'Home',
    meta: [
        {
            name: 'description',
            content: 'Home page'
        },
        {
            name: 'keywords',
            content: 'home, page, search, bike'
        }
    ]
}

export default {
    setup(){
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
            })
        })

        return { form }
    },
    layout : AppLayout,
    name: 'Home',
    props: {
        bikeModels: Array,
    },
    mounted() { // on page load
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
        }
    },
    methods: {
        getModels() { // get models for selected brand
            this.form.model = null;
            this.models = [];

            this.bikeModels.forEach(element => {
                if (element.brand == this.form.brand && !this.models.includes(element.model)){
                    this.models.push(element.model);
                }
            });

            return this.models;
        },
        submit() {
            this.form.transform((data) => ({
                ...data,
                minprice : data.price.min,
                maxprice : data.price.max,
                minyear : data.year.min,
                maxyear : data.year.max,
                minkm : data.km.min,
                maxkm : data.km.max,
                price: undefined,
                year: undefined,
                km: undefined,
                model: data.model || undefined,
                brand: data.brand || undefined,
            })).get('/ads');
        }
    },
    components: {
        Link
    }
}
</script>

<style>

#adv-search {
    color: #f50057;
}

</style>
