<template>
        <div class="row justify-center items-center ">
        <div class="col-xs-12 col-md-8 q-mt-xl">
    <q-card class="q-pa-md">
        <q-card-section class="q-gutter-md">
            <Link href="/home">
                <q-btn icon="arrow_back" flat round dense></q-btn>
            </Link>

            <h2>Create ad</h2>

            <form @submit.prevent="submit" enctype="multipart/form-data">
                <div class="row">
                    <q-input
                        class="col-grow q-ma-md"
                        type="number"
                        label="Prix"
                        v-model="form.price"
                        name="price"
                        id="inputPrice"
                        color="primary"
                        label-color="primary"
                        placeholder="9999.90"
                        :error="isError(form.errors.price)"
                        :error-message="form.errors.price"
                    />
                    <!--<div v-if="form.errors.inputPrice">{{ form.errors.inputPrice }}</div>-->

                    <q-input
                        class="col-grow q-ma-md"
                        type="number"
                        name="km"
                        label="Km"
                        v-model="form.km"
                        id="inputKm"
                        color="primary"
                        label-color="primary"
                        placeholder="12345"
                        :error="isError(form.errors.km)"
                        :error-message="form.errors.km"
                    />
                    <!--<div v-if="form.errors.km">{{ form.errors.km }}</div>-->

                    <q-input
                        type="number"
                        class="col-grow q-ma-md"
                        label="Puissance"
                        name="power_kw"
                        v-model="form.power_kw"
                        id="inputPower_kw"
                        step="0.1"
                        color="primary"
                        label-color="primary"
                        placeholder="349.9"
                        :error="isError(form.errors.power_kw)"
                        :error-message="form.errors.power_kw"
                    />
                    <!--<div v-if="form.errors.power_kw">{{ form.errors.power_kw }}</div>-->
                </div>

                <div class="row">
                    <div class="col-grow">
                        <q-select
                            v-model="form.color"
                            class="col-grow q-ma-md"
                            :options="colors"
                            label="Color"
                            filled
                            color="primary"
                            option-color
                            option-value="value"
                            option-label="label"
                            clearable
                            :error="isError(form.errors.color)"
                            :error-message="form.errors.color"
                        >
                        <template v-slot:option="scope">
                            <q-item v-bind="scope.itemProps" v-on="scope.itemEvents">
                            <q-item-section avatar>
                                <q-icon name="square" :color="scope.opt.value" />
                            </q-item-section>
                            <q-item-section>{{ scope.opt.label }}</q-item-section>
                            </q-item>
                        </template>

                    </q-select>

                        <!--<div v-if="form.errors.color_hexa">{{ form.errors.color_hexa }}</div>-->


                        <q-file
                            class="col-grow q-ma-md"
                            v-model="form.images"
                            @input="form.images = $event.target.files; preview($event);"

                            id="images"
                            name="images[]"
                            label="Images"
                            filled
                            multiple
                            color="primary" label-color="primary"

                            :error="isError(form.errors.files)"
                            :error-message="form.errors.files"
                        />
                        <!--<div v-if="form.errors.files">{{ form.errors.files }}</div>-->
                    </div>
                    <div class="col-grow">
                        <q-select
                            v-model="form.brand"
                            class="col-grow q-ma-md"
                            :options="brands_name"
                            label="Brand"
                            filled
                            color="primary"
                            label-color="primary"
                            @update:modelValue="getModels()"
                        />

                        <!-- model drop down, disabled when no brand selected -->
                        <q-select
                            v-model="form.model"
                            class="col-grow q-ma-md"
                            :options="models_name"
                            label="Model"
                            filled
                            color="primary"
                            label-color="primary"
                            :disable="!form.brand"

                            :error="isError(form.errors.model_id)"
                            :error-message="form.errors.model_id"
                        />

                        <!--<div v-if="form.errors.model_id"> {{ form.errors.model_id }} </div>-->
                    </div>
                </div>

                <q-carousel
                    class="col-grow q-ma-md"
                    v-if="urls.length > 0"
                    animated
                    v-model="slide"
                    arrows
                    navigation
                    infinite
                    >
                    <q-carousel-slide  v-for="url in urls" :name="url[0]" :img-src="url[1]"/>
                </q-carousel>

                <!-- submit -->
                <q-btn
                    type="submit"
                    class="col-grow q-ma-md"
                    :disabled="form.processing"
                    no-caps
                    color="primary"
                    label="Créer l'annonce"
                />

            </form>
        </q-card-section>
    </q-card>
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

export default {
    layout : AppLayout,
    name: 'Create ad',

    setup (props) {
        const form = useForm({
            price: null,
            km: null,
            power_kw: null,
            color: '',
            user_id: props.user.id,
            brand: null,
            model: null,
            images: null,
        })

        return { form, slide: ref(1) }
    },

    methods: {
        preview(e) // Setup preview for selected images
        {
            this.urls = [];
            let cpt = 1;
            Array.from(e.target.files).forEach(file => {
                this.urls.push([cpt, URL.createObjectURL(file)]);
                cpt += 1;
            });
        },

        getModels() { // get models from api
            this.models_name = [];

            this.form.model = null;

            this.models.forEach(element => {
                if (element.brand == this.form.brand && !this.models.includes(element.model)){
                    this.models_name.push(element.model);
                }
            });

            return this.models;
        },

        getModelIdFromBrandAndModel(model, brand) { // get model id from name
            let id = null;
            this.models.forEach(element => {
                if (element.model == model && element.brand == brand){
                    id = element.id;
                }
            });

            return id;
        },

        submit()
        {
            this.form.transform((data) => ({
                    price: data.price,
                    km: data.km,
                    power_kw: data.power_kw,
                    color: data.color != null ? data.color.value : undefined,
                    user_id: data.user_id,
                    model_id: this.getModelIdFromBrandAndModel(this.form.model, this.form.brand),
                    images: data.images,
                }))
                .post('/ads');
        },
        isError(field){
            return field ? true : false;
        }
    },

    props: {
        models: Array,
        user: Object,
    },

    mounted() { // on page load
        this.models.forEach(element => {
            if (!this.brands_name.includes(element.brand)){
                this.brands_name.push(element.brand);
            }
        });
    },

    data() {
        return {
            urls: [],  // preview
            brands_name: [],
            models_name: [],
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
}

</script>

<style>

</style>
