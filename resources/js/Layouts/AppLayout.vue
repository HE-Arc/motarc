<template>
    <head>
        <!-- add favicons -->
        <link rel="icon" type="image/png" sizes="32x32" href="/public/storage/images/moto_pink_32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/public/storage/images/moto_pink_16x16.png">
    </head>
    <q-layout>
    <Header></Header>
    <q-page-container>
        <q-page>
            <!--<div v-if="$page.props.flash.success" class="q-pa-md bg-green-2 text-green-7">
                {{$page.props.flash.success}}
            </div>-->
            <slot></slot>
        </q-page>
    </q-page-container>
    <!-- <Footer /> -->
    </q-layout>
</template>

<script>
import Header from './Header.vue'
import Footer from './Footer.vue'
import { useQuasar } from 'quasar'

export default {
    name: 'AppLayout',
    components: {
        Header,
        Footer
    },
    setup() {
        const $q = useQuasar()
        return {
            showSuccess (mess) {
                $q.notify({
                message: mess,
                color: 'green-2',
                textColor: 'green-8',
                actions: [{ icon: 'close', color: 'green-8' }]
                })
            }
        }
    },
    // detect change of flash message
    watch: {
        '$page.props.flash.success': function (val) {
            if (val) {
                this.showSuccess(val)
            }
        }
    }
}
</script>


