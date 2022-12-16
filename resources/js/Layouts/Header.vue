<template>
    <div class="q-pa-md bg-grey-3" id="navbar" >
        <q-toolbar>
            <img src="/storage/images/moto.png" height="30" />
            <q-toolbar-title>
                <Link href="/" id="link-title">
                <q-btn flat label="Motarc">
                </q-btn>
                </Link>
            </q-toolbar-title>
            <q-space />
            <q-tabs v-model="tab" shrink>
                <Link href="/">
                    <q-tab name="tab1" label="Search" />
                </Link>
                <Link href="/ads/create"> <!--v-if="$page.props.auth.user">-->
                    <q-tab name="tab2" label="New ad" />
                </Link>
            </q-tabs>
            <q-space />
            <q-btn-dropdown stretch flat label="Mon compte">
                <q-list>
                    <!-- if user not logged in, register and login pages -->
                    <div v-if="$page.props.auth.user">
                        <Link href="/profile">
                        <q-item clickable v-ripple>
                            <q-item-section>
                                My profile
                            </q-item-section>
                        </q-item>
                        </Link>

                        <Link href="/ads/myads">
                        <q-item clickable v-ripple>
                            <q-item-section>
                                My ads
                            </q-item-section>
                        </q-item>
                        </Link>

                        <Link href="/favourites">
                        <q-item clickable v-ripple>
                            <q-item-section>
                                My favourites
                            </q-item-section>
                        </q-item>
                        </Link>

                        <Link href="/logout">
                        <q-item clickable v-ripple>
                            <q-item-section>
                                Logout
                            </q-item-section>
                        </q-item>
                        </Link>
                    </div>
                    <div v-else>
                        <Link href="/login">
                        <q-item v-ripple>
                            <q-item-section>
                                Login
                            </q-item-section>
                        </q-item>
                        </Link>
                        <Link href="/register">
                        <q-item v-ripple>
                            <q-item-section>
                                Register
                            </q-item-section>
                        </q-item>
                        </Link>
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

a:visited {
    color: black;
}

a:hover {
    color: #f50057;
}

a {
    text-decoration: none;
}

#link-title:hover {
    color: black;
}

</style>
