<template>
    <q-card class="q-pa-md">
        <q-card-section class="q-gutter-md">
            <h1>Create ad</h1>

            <form @submit.prevent="submit" enctype="multipart/form-data">
                <div class="row">
                    <q-input
                        class="col-grow q-ma-md"
                        type="number"
                        label="Prix"
                        v-model="form.price"
                        name="price"
                        id="inputPrice"
                        color="deep-orange-9"
                        label-color="deep-orange-9"
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
                        color="deep-orange-9"
                        label-color="deep-orange-9"
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
                        color="deep-orange-9"
                        label-color="deep-orange-9"
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
                        color="deep-orange-9"
                        label-color="deep-orange-9"
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
                        color="deep-orange-9"
                        label-color="deep-orange-9"
                    />

                    <div v-if="form.errors.model_id">
                        {{ form.errors.model_id }}
                    </div>
                </div>

                <q-file
                    v-model="form.images"
                    @input="form.images = $event.target.files"
                    id="images"
                    name="images[]"
                    label="Images"
                    filled
                    multiple
                    color="deep-orange-9" label-color="deep-orange-9"
                />
                <div v-if="form.errors.files">{{ form.errors.files }}</div>

                <!-- submit -->
                <q-btn
                    type="submit"
                    class="col-grow q-ma-md"
                    :disabled="form.processing"
                    no-caps
                    color="deep-orange-9"
                    label="Créer"
                />

            </form>
        </q-card-section>
    </q-card>
</template>

<script>

import { Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'
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
            color_hexa: null,
            user_id: props.user.id,
            model_id: null,
            images: null,
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
                .post('/ads');
        }

        return { form, submit }
    },

    props: {
        models: Array,
        user: Object,
    },

    data() {
        return {
            model_options: this.models.map(m => {
                return {
                    value: m.id + 0,
                    label: m.model + " " + m.year + " " + m.capacity,
                }
            })
        }
    },
}

</script>

<style>

</style>
