<template>
    <div class="column">
        <h3>Register</h3>
        <form @submit.prevent="form.post('/users')">
            <q-input v-model="form.name" type="text" id="name" label="Name" placeholder="Your name" color="deep-orange-9" label-color="deep-orange-9" :rules="[val => !!val || 'Field is required']"/>
            <div class="alert alert-danger" v-if="form.errors.name">{{ form.errors.name }} </div>
            <q-input v-model="form.npa" type="number" id="npa" label="NPA" placeholder="Your NPA" color="deep-orange-9" label-color="deep-orange-9" :rules="[val => !!val || 'Field is required']"/>
            <div class="alert alert-danger" v-if="form.errors.npa">{{ form.errors.npa }} </div>
            <q-input v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="deep-orange-9" label-color="deep-orange-9" :rules="[val => !!val || 'Field is required']"/>
            <div class="alert alert-danger" v-if="form.errors.email">{{ form.errors.email }} </div>
            <q-input v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="deep-orange-9" label-color="deep-orange-9" :rules="[val => !!val || 'Field is required']" />
            <div class="alert alert-danger" v-if="form.errors.password">{{ form.errors.password }} </div>
            <q-input v-model="form.password_confirmation" type="password" id="password" label="Password confirmation" placeholder="Your password" color="deep-orange-9" label-color="deep-orange-9" :rules="[val => !!val || 'Field is required']" />
            <div class="alert alert-danger" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }} </div>
            <q-btn type="submit" :disabled="form.processing" no-caps color="deep-orange-9" label="Register" />
        </form>
        <p class="text-blue-grey-4">Have an account ? <Link class="text-orange-9" href="/login">Login</Link></p>
    </div>
</template>
<script>

import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

export default {
    layout : AppLayout,
    components: {
        Link
    },
    setup(){
        const form = useForm({
            name: '',
            npa: '',
            email: '',
            password: '',
            password_confirmation: '',
        })

        return { form }
    },
}

</script>
<style>
</style>
