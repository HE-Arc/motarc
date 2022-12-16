<template>
    <!--<AppLayout>-->
    <Head title="Login"></Head>
    <q-card>
        <q-card-section>
            <h2>Login</h2>
            <div class="column">
                <form @submit.prevent="form.post('/login')">
                    <div class="alert alert-danger" v-if="form.errors.email">
                        {{ form.errors.email }}
                    </div>
                    <q-input v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="primary" label-color="primary"/>
                    <q-input v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="primary" label-color="primary"/>
                    <q-btn type="submit" :disabled="form.processing" no-caps color="primary" label="Login" />
                </form>
                <p class="text-blue-grey-4">Doesn't have an account ? <Link href="/register" id="register-link">Register</Link></p>
            </div>
<<<<<<< HEAD
            <q-input v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="primary" label-color="primary"/>
            <q-input v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="primary" label-color="primary"/>
            <q-btn type="submit" :disabled="form.processing" no-caps color="primary" label="Login" />
        </form>
        <p class="text-blue-grey-4">Doesn't have an account ? <Link class="text-orange-9" href="/register">Register</Link></p>
    </div>
=======
        </q-card-section>
    </q-card>
>>>>>>> 98f0892 (Fix issues #12, #5, #4)
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

#register-link {
    color: #f50057;
}

</style>
