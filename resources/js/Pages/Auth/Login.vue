<template>
    <div class="row justify-center items-center ">
        <div class="col-xs-12 col-md-6 q-mt-xl">
            <q-card>
                <q-card-section>
                    <h2 class="q-pl-md">Login</h2>
                    <div class="column">
                        <form @submit.prevent="form.post('/login')">
                            <q-input :error="isErrorEmpty(form.errors.email)" :error-message="form.errors.email" v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="primary" label-color="primary" class="q-ma-md"/>
                            <q-input :error="isErrorEmpty(form.errors.email)" :error-message="form.errors.email" v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="primary" label-color="primary" class="q-ma-md"/>
                            <q-btn type="submit" :disabled="form.processing" no-caps color="primary" label="Login" class="q-ma-md" />
                        </form>
                        <p class="text-blue-grey-4 q-pa-md">Doesn't have an account ? <Link href="/register" id="register-link">Register</Link></p>
                    </div>
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>
<script>
import { Head, useForm, Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { useMeta } from 'quasar'

const metaData = {
    title: 'Login',
    meta: [
        {
            name: 'description',
            content: 'Login page'
        },
        {
            name: 'keywords',
            content: 'login, page'
        }
    ]
}

export default {
    layout : AppLayout,
    components: {
        Link,
        Head
    },
    setup(){
        useMeta(metaData);
        const form = useForm({
            email: '',
            password: '',
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

#register-link {
    color: #f50057;
}

</style>
