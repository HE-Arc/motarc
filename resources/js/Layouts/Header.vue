<template>
    <div class="q-pa-md bg-grey-3" id="navbar" >
        <q-toolbar>
            <img src="storage/images/moto.png" height="30" />
            <q-toolbar-title>
                <Link href="/">
                <q-btn flat label="Motarc" to="/">
                </q-btn>
                </Link>
            </q-toolbar-title>
            <q-space />
            <q-tabs v-model="tab" shrink>
                <Link href="/">
                    <q-tab name="tab1" label="Search" />
                </Link>
                <Link href="/ads/create">
                    <q-tab name="tab2" label="New ad" />
                </Link>
            </q-tabs>
            <q-space />
            <q-btn-dropdown stretch flat label="Mon compte">
                <q-list>
                    <!-- if user not logged in, register and login pages -->
                    <div v-if="$page.props.auth.user">
                        <q-item clickable v-ripple>
                            <Link href="/profile">
                            <q-item-section>
                                My profile
                            </q-item-section>
                            </Link>
                        </q-item>

                        <q-item clickable v-ripple>
                            <Link href="/ads/myads">
                            <q-item-section>
                                My ads
                            </q-item-section>
                            </Link>
                        </q-item>

                        <q-item clickable v-ripple>
                            <Link href="/favourites">
                            <q-item-section>
                                My favourites
                            </q-item-section>
                            </Link>
                        </q-item>

                        <q-item clickable v-ripple>
                            <Link href="/logout">
                            <q-item-section>
                                Logout
                            </q-item-section>
                            </Link>
                        </q-item>
                    </div>
                    <div v-else>
                        <q-item v-ripple>
                            <Link href="/login">
                            <q-item-section>
                                Login
                            </q-item-section>
                            </Link>
                        </q-item>
                        <q-item v-ripple>
                            <Link href="/register">
                            <q-item-section>
                                Register
                            </q-item-section>
                            </Link>
                        </q-item>
                    </div>
                </q-list>
            </q-btn-dropdown>
        </q-toolbar>
    </div>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: 'Header',
    components: {
        Link
    },
}
</script>

<style>

</style>
