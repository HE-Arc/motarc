<template>
    <div class="column">
        <h3>Register</h3>
        <form @submit.prevent="form.post('users.store')">
            <div class="alert alert-danger" v-if="form.errors.email">
                {{ form.errors.email }}
            </div>
            <q-input v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="deep-orange-9" label-color="deep-orange-9" :rules="[val => !!val || 'Field is required']"/>
            <q-input v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="deep-orange-9" label-color="deep-orange-9" :rules="[val => !!val || 'Field is required']" />
            <q-input v-model="form.password_confirmation" type="password" id="password" label="Password confirmation" placeholder="Your password" color="deep-orange-9" label-color="deep-orange-9" :rules="[val => !!val || 'Field is required']" />
            <q-btn type="submit" :disabled="form.processing" no-caps color="deep-orange-9" label="Login" />
        </form>
        <p class="text-blue-grey-4">Doesn't have an account ? <Link class="text-orange-9" href="/register">Register</Link></p>
    </div>
</template>
<script>
</script>
<style>
</style>
