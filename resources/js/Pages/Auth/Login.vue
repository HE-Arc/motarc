<template>
    <div class="column">
        <h3>Login</h3>
        <!-- Error div -->
        <div v-if="error" class="alert alert-danger">
            {{ error }}
        </div>
        <form @submit.prevent="login">
            <q-input v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="deep-orange-9" label-color="deep-orange-9"/>
            <q-input v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="deep-orange-9" label-color="deep-orange-9"/>
            <q-btn type="submit" no-caps color="deep-orange-9" label="Login" />
        </form>
        <p class="text-blue-grey-4">Doesn't have an account ? <a class="text-orange-9" href="">Sign up</a></p>
    </div>
</template>
<script>
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'

export default {
    setup(){
        const form = reactive({
            email: '',
            password: '',
        })

        const error = null

        const login = () => {
            Inertia.post('/login', form)
                .then(() => {
                    error.value = null
                })
                .catch((error) => {
                    error.value = error.response.data.errors
                })
        }

        return {
            form,
            error,
            login,
        }
    },
}

</script>
<style>
</style>
