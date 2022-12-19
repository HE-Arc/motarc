<template>
    <div class="row justify-center items-center ">
        <div class="col-xs-12 col-md-6 q-mt-xl">
        <q-card class="q-pa-lg">
            <q-card-section>
                <!-- Back button with arrow icon -->
                <Link href="/profile">
                    <q-btn icon="arrow_back" flat round dense></q-btn>
                </Link>

                <h2>Edit profile</h2>

                <!-- update password dialog -->
                <q-dialog v-model="showPasswordPopup" persistent>
                    <q-card>
                        <form @submit.prevent="form.put('/profile')">
                            <q-card-section class="row items-center">
                                <div class="text-h6">Update password</div>
                            </q-card-section>

                            <q-card-section>
                                <q-input :error="isErrorField(form.errors.password)" :error-message="form.errors.password" v-model="form.password" type="password" id="password" label="Password" placeholder="Your password" color="primary" label-color="primary" />
                                <!--<div v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</div>-->
                                <q-input :error="isErrorField(form.errors.password_confirmation)" :error-message="form.errors.password_confirmation" v-model="form.password_confirmation" type="password" id="password" label="Password confirmation" placeholder="Your password" color="primary" label-color="primary" />
                                <!--<div v-if="form.errors.password_confirmation" class="text-red-500">{{ form.errors.password_confirmation }}</div>-->
                            </q-card-section>

                            <q-card-actions align="right">
                                <q-btn flat label="Cancel" color="primary" @click="showPasswordPopup = false" />
                                <q-btn label="Update" type="submit" :disabled="form.processing" color="primary" />
                            </q-card-actions>
                        </form>
                    </q-card>
                </q-dialog>

                <!-- Dialog to delete user -->
                <q-dialog v-model="showDeletePopup" persistent>
                    <q-card>
                        <q-card-section class="row items-center">
                            <div class="text-h6">Delete account</div>
                        </q-card-section>

                        <q-card-section>
                            <p>Are you sure you want to delete your account?</p>
                        </q-card-section>

                        <q-card-actions align="right">
                            <q-btn flat label="Cancel" color="primary" @click="showDeletePopup = false" />
                            <Link :href="'/users/'+$page.props.auth.user.id" method="delete">
                                <q-btn label="Delete" type="submit" color="primary"></q-btn>
                            </Link>
                        </q-card-actions>
                    </q-card>
                </q-dialog>

                <form @submit.prevent="form.put('/profile')">
                    <q-input :error="isErrorField(form.errors.name)" :error-message="form.errors.name" v-model="form.name" type="text" id="name" label="Name" placeholder="Your name" color="primary" label-color="primary" />
                    <!--<div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>-->
                    <q-input :error="isErrorField(form.errors.npa)" :error-message="form.errors.npa" class="q-mt-sm" v-model="form.npa" type="number" id="npa" label="NPA" placeholder="Your NPA" color="dprimary" label-color="primary" />
                    <!--<div v-if="form.errors.npa" class="text-red-500">{{ form.errors.npa }}</div>-->
                    <q-input :error="isErrorField(form.errors.email)" :error-message="form.errors.email" class="q-mt-sm" v-model="form.email" type="email" id="email" label="E-mail" placeholder="Your e-mail adress" color="primary" label-color="primary" />
                    <!--<div v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</div>-->

                    <!-- Button to update passwork with lock icon -->
                    <div class="col">
                        <q-btn class="q-mt-md q-mr-md" size="md" @click="showPasswordPopup = true" icon="lock">Update password</q-btn>
                        <q-btn class="q-mt-md" type="submit" :disabled="form.processing" no-caps color="primary" label="UPDATE" />
                    </div>
                </form>

                <q-btn size="sm" class="q-mt-xl" color="red" icon="warning" @click="showDeletePopup = true">Delete account</q-btn>
            </q-card-section>
        </q-card>
    </div>
</div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'

export default {
    layout : AppLayout,
    name: 'Edit current user',
    props: {
        user: Object,
    },
    components: {
        Link
    },
    setup(props) {
        const form = useForm({
            name: props.user.name,
            npa: props.user.npa,
            email: props.user.email,
            password: '',
            password_confirmation: '',
        });

        const showPasswordPopup = ref(false);
        const showDeletePopup = ref(false);

        return { form, showPasswordPopup, showDeletePopup }
    },
    methods: {
        isErrorField(field){
            return field ? true : false
        }
    }
}

</script>

<style>

</style>
