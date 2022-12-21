<template>
<div class="row justify-center items-center ">
    <div class="col-xs-12 col-md-6 q-mt-xl">
        <q-card class="q-px-md">
            <q-card-section>
                <div class="column">
                    <h3>Register</h3>
                    <form @submit.prevent="form.post('/users')">
                        <q-input :error="isErrorEmpty(form.errors.name)" :error-message="form.errors.name" v-model="form.name" type="text" id="name" label="Name" placeholder="Your name" color="primary" label-color="primary"/>
                        <q-input :error="isErrorEmpty(form.errors.npa)" :error-message="form.errors.npa" v-model="form.npa" type="number" id="npa" label="NPA" placeholder="Your NPA" color="primary" label-color="primary"/>
                        <q-input :error="isErrorEmpty(form.errors.email)" :error-message="form.errors.email" v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="primary" label-color="primary"/>
                        <q-input :error="isErrorEmpty(form.errors.password)" :error-message="form.errors.password" v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="primary" label-color="primary" />
                        <q-input :error="isErrorEmpty(form.errors.password_confirmation)" :error-message="form.errors.password_confirmation" v-model="form.password_confirmation" type="password" id="password" label="Password confirmation" placeholder="Your password" color="primary" label-color="primary" />
                        <q-btn type="submit" :disabled="form.processing" no-caps color="primary" label="Register" />
                    </form>
                    <p class="text-blue-grey-4 q-mt-md">Have an account ? <Link id="login-link" href="/login">Login</Link></p>
                </div>
            </q-card-section>
        </q-card>
    </div>
</div>
</template>
<script>
import { useForm, Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { useMeta } from 'quasar'

const metaData = {
    title: 'Register',
    meta: [
        {
            name: 'description',
            content: 'Register page'
        },
        {
            name: 'keywords',
            content: 'register, page'
        }
    ]
}

export default {
    layout : AppLayout,
    components: {
        Link
    },
    setup(){
        useMeta(metaData);
        const form = useForm({
            name: '',
            npa: '',
            email: '',
            password: '',
            password_confirmation: '',
        })
        return { form }
    },
    methods: {
        isErrorEmpty(field){
            return field ? true : false
        }
    }
}

</script>
<style>
#login-link {
    color: #f50057;
}
</style>
