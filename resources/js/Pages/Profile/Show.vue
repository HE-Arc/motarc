<template>
    <div class="row justify-center items-center ">
        <div class="col-xs-12 col-md-6 q-mt-xl">
            <q-card>
                <q-card-section>
                    <div class="q-mx-md">
                        <h2>My profile</h2>

                        <div class="row items-center">
                            <!-- Icons column -->
                            <div class="col-2">
                                <div class="row q-ma-sm q-mb-md">
                                    <q-icon name="person" class="q-mr-sm"/>
                                    <q-item-label class="text-weight-bold"> Name </q-item-label>
                                </div>
                                <div class="row q-ma-sm q-mb-md">
                                    <q-icon name="email" class="q-mr-sm" />
                                    <q-item-label class="text-weight-bold"> Email </q-item-label>
                                </div>
                                <div class="row q-ma-sm q-mb-md">
                                    <q-icon name="location_on" class="q-mr-sm" />
                                    <q-item-label class="text-weight-bold"> NPA </q-item-label>
                                </div>
                            </div>

                            <!-- Values column -->
                            <div class="col-10">
                                <div class="row q-ma-sm q-mb-md">
                                    <q-item-label caption>{{ user.name }}</q-item-label>
                                </div>
                                <div class="row q-ma-sm q-mb-md">
                                    <q-item-label caption>{{ user.email }}</q-item-label>
                                </div>
                                <div class="row q-ma-sm q-mb-md">
                                    <q-item-label caption>{{ user.npa }}</q-item-label>
                                </div>
                            </div>
                        </div>

                        <!-- Button modify -->
                        <Link href="/profile/edit">
                        <q-btn
                            class="q-my-md"
                            color="primary"
                            to="/profile/edit"
                            label="Modify"
                        >
                        </q-btn>
                        </Link>
                    </div>
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    layout : AppLayout,
    name: 'Show profile',
    props: {
        user: Object,
    },
    components: {
        Link
    },
}

</script>

<style>

</style>
