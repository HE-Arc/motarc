<template>
        <q-header elevated class="bg-grey-3 q-pa-sm">
        <q-toolbar>
            <q-btn v-if="$q.screen.lt.md" flat round dense icon="menu" @click="drawer = !drawer" color="black" class="q-mr-md" />
            <img src="/storage/images/moto.png" height="30" />
            <q-toolbar-title>
                <Link href="/" id="link-title">
                <q-btn flat label="Motarc">
                </q-btn>
                </Link>
            </q-toolbar-title>
            <q-space />
             <!-- To put in a dropdown menu is small screen -->
            <!--<q-tabs v-model="tab" shrink>-->
                <Link href="/" v-if="$q.screen.gt.sm">
                    <q-btn name="tab1" label="Search" flat icon="search" />
                </Link>
                <Link href="/ads/create" v-if="$q.screen.gt.sm"> <!--v-if="$page.props.auth.user">-->
                    <q-btn name="tab2" label="New ad" flat icon="add" />
                </Link>
            <!--</q-tabs>-->
            <q-space />
            <q-btn-dropdown stretch flat label="Mon compte" color="black" icon="account_circle " v-if="$q.screen.gt.sm">
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


            <!-- div if small screen -->


        </q-toolbar>
    </q-header>



        <q-drawer
        v-model="drawer"
        :width="200"
        :breakpoint="200"
        overlay
        bordered
        class="bg-grey-1"
      >
        <q-scroll-area class="fit">
          <q-list>
            <Link href="/">
              <q-item clickable v-ripple>
                <q-item-section avatar>
                    <q-icon name="search" />
                </q-item-section>
                <q-item-section>
                  Search
                </q-item-section>
              </q-item>
            </Link>
            <Link href="/ads/create">
              <q-item clickable v-ripple>
                <q-item-section avatar>
                    <q-icon name="add" />
                </q-item-section>
                <q-item-section>
                  New ad
                </q-item-section>
              </q-item>
            </Link>
              <q-separator inset />
              <div v-if="$page.props.auth.user">
                <Link href="/profile">
                <q-item clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="account_circle" />
                    </q-item-section>
                    <q-item-section>
                        My profile
                    </q-item-section>
                </q-item>
                </Link>

                <Link href="/ads/myads">
                <q-item clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="two_wheeler" />
                    </q-item-section>
                    <q-item-section>
                        My ads
                    </q-item-section>
                </q-item>
                </Link>

                <Link href="/favourites">
                <q-item clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="favorite" />
                    </q-item-section>
                    <q-item-section>
                        My favourites
                    </q-item-section>
                </q-item>
                </Link>

                <Link href="/logout">
                <q-item clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="logout" />
                    </q-item-section>
                    <q-item-section>
                        Logout
                    </q-item-section>
                </q-item>
                </Link>
              </div>
              <div v-else>
                <Link href="/login">
                <q-item v-ripple>
                    <q-item-section avatar>
                        <q-icon name="login" />
                    </q-item-section>
                    <q-item-section>
                        Login
                    </q-item-section>
                </q-item>
                </Link>
                <Link href="/register">
                <q-item v-ripple>
                    <q-item-section avatar>
                        <q-icon name="how_to_reg" />
                    </q-item-section>
                    <q-item-section>
                        Register
                    </q-item-section>
                </q-item>
                </Link>
              </div>
          </q-list>
        </q-scroll-area>
      </q-drawer>

</template>

<script>

import { Link } from '@inertiajs/inertia-vue3';

export default {
    name: 'Header',
    components: {
        Link
    },
    data() {
        return {
            drawer: false,
            tab: 'tab1'
        }
    }
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
