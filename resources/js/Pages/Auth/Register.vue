<template>
    <q-card>
        <q-card-section>
            <div class="column">
                <h3>Register</h3>
                <form @submit.prevent="form.post('/users')">
                    <q-input v-model="form.name" type="text" id="name" label="Name" placeholder="Your name" color="primary" label-color="primary" :rules="[val => !!val || 'Field is required']"/>
                    <div class="alert alert-danger" v-if="form.errors.name">{{ form.errors.name }} </div>
                    <q-input v-model="form.npa" type="number" id="npa" label="NPA" placeholder="Your NPA" color="primary" label-color="primary" :rules="[val => !!val || 'Field is required']"/>
                    <div class="alert alert-danger" v-if="form.errors.npa">{{ form.errors.npa }} </div>
                    <q-input v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="primary" label-color="primary" :rules="[val => !!val || 'Field is required']"/>
                    <div class="alert alert-danger" v-if="form.errors.email">{{ form.errors.email }} </div>
                    <q-input v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="primary" label-color="primary" :rules="[val => !!val || 'Field is required']" />
                    <div class="alert alert-danger" v-if="form.errors.password">{{ form.errors.password }} </div>
                    <q-input v-model="form.password_confirmation" type="password" id="password" label="Password confirmation" placeholder="Your password" color="primary" label-color="primary" :rules="[val => !!val || 'Field is required']" />
                    <div class="alert alert-danger" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }} </div>
                    <q-btn type="submit" :disabled="form.processing" no-caps color="primary" label="Register" />
                </form>
                <p class="text-blue-grey-4">Have an account ? <Link id="login-link" href="/login">Login</Link></p>
            </div>
        </q-card-section>
    </q-card>
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
#login-link {
    color: #f50057;
}
</style>
