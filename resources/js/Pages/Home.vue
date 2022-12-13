<template>
    <!-- form in a q-card -->
    <q-card>
        <q-card-section>
            <q-form>
                <!-- brand drop down -->
                <q-select
                    v-model="brand"
                    :options="brands"
                    label="Brand"
                    filled
                    @update:modelValue="getModels"
                />
                <!-- model drop down, disabled when no brand selected -->
                <q-select
                    v-model="model"
                    :options="models"
                    label="Model"
                    filled
                    :disable="!brand"
                />
                <!-- Price range -->
                <q-range
                    v-model="price"
                    label="Price"
                    suffix="CHF"
                    :min="0"
                    :max="10000"
                    :step="100"
                    label-always
                    color="red"
                >
                </q-range>
                <!-- KM range -->
                <q-input
                    v-model="km"
                    label="KM"
                    filled
                    type="number"
                    suffix="km"
                />
                <!-- Year range -->
                <q-input
                    v-model="year"
                    label="Year"
                    filled
                    type="number"
                    suffix="year"
                />
                <!-- Button submit -->
                <q-btn
                    label="Search"
                    type="submit"
                    color="red"
                    @click="submit"
                />
            </q-form>
        </q-card-section>
    </q-card>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';

export default {
    layout : AppLayout,
    name: 'Home',
    props: {
        bikeModels: Array,
    },
    // change models when brand changes
    watch: {
        brand: function () {
            this.models = this.getModels();
        }
    },
    // on page load
    mounted() {
        this.bikeModels.forEach(element => {
            // if brand is not in brands array, add it
            if (!this.brands.includes(element.brand)){
                this.brands.push(element.brand);
            }
        });
    },
    data() {
        return {
            brand: '',
            model: '',
            price: '',
            km: '',
            year: '',
            brands: [],
            models: [],
        }
    },
    methods: {
        // get models from api
        getModels() {
            console.log(this.brand);
            this.models = [];
            this.bikeModels.forEach(element => {
                if (element.brand == this.brand && !this.models.includes(element.model)){
                    this.models.push(element.model);
                }
            });
            //this.models = ['test', 'test2'];
            console.log(this.models.length)

            return this.models;
        },
        // submit form
        submit() {}
    }
}
</script>

<style>


</style>
