<template>
    <!-- form in a q-card -->
    <q-card>
        <q-card-section>
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
                />

                <!-- Label abow price range -->
                <q-label>Price</q-label>
                <!-- Price range -->
                <q-range
                    v-model="form.price"
                    suffix="CHF"
                    :min="0"
                    :max="10000"
                    :step="100"
                    label-always
                    color="red"
                >
                </q-range>

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
                    color="red"
                    label-always
                />
                <!-- Year range -->
                <q-label>Year</q-label>
                <q-range
                    v-model="form.year"
                    filled
                    type="number"
                    suffix="year"
                    :min="1900"
                    :max="2022"
                    :step="1"
                    color="red"
                    label-always
                />
                <!-- Button submit -->
                <q-btn
                    label="Search"
                    type="submit"
                    color="red"
                    @click="submit"
                />
            </form>
        </q-card-section>
    </q-card>
</template>

<script>
import { ref } from 'vue';
import { reactive } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
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
        getModels() { // get models from api
            this.models = [];
            //console.log(this.form.brand)
            this.bikeModels.forEach(element => {
                if (element.brand == this.form.brand && !this.models.includes(element.model)){
                    this.models.push(element.model);
                }
            });
            //console.log(this.models)
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
}
</script>

<style>


</style>