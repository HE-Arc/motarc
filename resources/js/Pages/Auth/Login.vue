<template>
    <!--<AppLayout>-->
    <Head title="Login"></Head>
    <div class="column">
        <h3>Login</h3>
        <form @submit.prevent="form.post('/login')">
            <div class="alert alert-danger" v-if="form.errors.email">
                {{ form.errors.email }}
            </div>
            <q-input v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="deep-orange-9" label-color="deep-orange-9"/>
            <q-input v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="deep-orange-9" label-color="deep-orange-9"/>
            <q-btn type="submit" :disabled="form.processing" no-caps color="deep-orange-9" label="Login" />
        </form>
        <p class="text-blue-grey-4">Doesn't have an account ? <Link class="text-orange-9" href="/register">Register</Link></p>
    </div>
    <!--</AppLayout>-->
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
    components: {
        Link,
        Head
    },
    setup(){
        const form = useForm({
            email: '',
            password: '',
        })

        return { form }
    },
}

</script>
<style>
</style>
