<template>
    <q-card class="q-pa-md">
        <q-card-section class="q-gutter-md">
            <h2>Edit ad</h2>

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
                    />
                    <div v-if="form.errors.inputPrice">{{ form.errors.inputPrice }}</div>

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
                    />
                    <div v-if="form.errors.km">{{ form.errors.km }}</div>

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
                    />
                    <div v-if="form.errors.power_kw">{{ form.errors.power_kw }}</div>
                </div>

                <div class="row">
                    <q-select
                        v-model="form.color_hexa"
                        class="col-grow q-ma-md"
                        :options="colors"
                        label="Color"
                        filled
                        color="primary"
                        option-color
                        option-value="value"
                        option-label="label"
                        clearable
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

                    <div v-if="form.errors.color_hexa">
                        {{ form.errors.color_hexa }}
                    </div>

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
                    />

                    <div v-if="form.errors.model_id">
                        {{ form.errors.model_id }}
                    </div>
                </div>

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
                />
                <div v-if="form.errors.files">{{ form.errors.files }}</div>

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
                    label="Modifier l'annonce"
                />

            </form>
        </q-card-section>
    </q-card>
</template>

<script>

import { Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { reactive, ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { propsToAttrMap } from '@vue/shared'


export default {
    layout : AppLayout,
    name: 'Edit ad',

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

    mounted() { // on page load
        this.models.forEach(element => {
            if (!this.brands_name.includes(element.brand)){
                this.brands_name.push(element.brand);
            }
        });

        this.getModels();

        this.form.model = this.$page.props.ad.model.model;

    },

    setup (props) {
        const form = useForm({
            price: props.ad.price,
            km: props.ad.km,
            power_kw: props.ad.power_kw,
            color_hexa: props.ad.color_hexa,
            user_id: props.ad.user_id,
            brand: props.ad.model.brand,
            model: props.ad.model.model,
            images: null,
            _method: 'patch',
        })

        // Set up urls for preview
        var urls = [];
        let cpt = 1;
        props.ad.images.forEach(image => {
            urls.push([cpt, "/storage/images/" + image.image_url]);
            cpt += 1;
        });

        return { form, slide: ref(1), urls: urls }
    },

    props: {
        models: Array,
        ad: Object,
    },

    methods: {
        preview(e)
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
                color_hexa: data.color_hexa.value,
                user_id: data.user_id,
                model_id: this.getModelIdFromBrandAndModel(this.form.model, this.form.brand),
                images: data.images,
            }))
            .post("/ads/" + this.$page.props.ad.id + "/update");
        },
    },
}

</script>

<style>

</style>
