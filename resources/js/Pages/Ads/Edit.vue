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
                    <q-input
                        class="col-grow q-ma-md"
                        type="text"
                        label="Couleur"
                        name="color_hexa"
                        v-model="form.color_hexa"
                        id="inputColor"
                        color="primary"
                        label-color="primary"
                        placeholder="#AABBCC"
                    />

                    <div v-if="form.errors.color_hexa">
                        {{ form.errors.color_hexa }}
                    </div>

                    <q-select
                        class="col-grow q-ma-md"
                        name="model_id"
                        label="Modèle"
                        v-model="form.model_id"
                        :options="model_options"
                        id="model_id"
                        color="primary"
                        label-color="primary"
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
            model_options: this.models.map(m => {
                return {
                    value: m.id + 0,
                    label: m.model + " " + m.year + " " + m.capacity,
                }
            }),
            urls: [],  // preview
        }
    },

    setup (props) {
        const form = useForm({
            price: props.ad.price,
            km: props.ad.km,
            power_kw: props.ad.power_kw,
            color_hexa: props.ad.color_hexa,
            user_id: props.ad.user_id,
            model_id: {
                    value: props.ad.model.id + 0,
                    label: props.ad.model.model + " " + props.ad.model.year + " " + props.ad.model.capacity,
                },
            images: null,
            _method: 'patch',
        })

        function submit()
        {
            form.transform((data) => ({
                    price: data.price,
                    km: data.km,
                    power_kw: data.power_kw,
                    color_hexa: data.color_hexa,
                    user_id: data.user_id,
                    model_id: data.model_id.value,
                    images: data.images,
                }))
                .post("/ads/" + props.ad.id + "/update");
        }

        // Set up urls for preview
        var urls = [];
        let cpt = 1;
        props.ad.images.forEach(image => {
            urls.push([cpt, "/storage/images/" + image.image_url]);
            cpt += 1;
        });

        return { form, submit, slide: ref(1), urls: urls }
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
    },

    props: {
        models: Array,
        ad: Object,
    },
}

</script>

<style>

</style>
