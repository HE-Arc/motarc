<template>
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
                textColor: 'green-7',
                actions: [{ icon: 'close', color: 'green-7' }]
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


