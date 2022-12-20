import './bootstrap';
import { createApp, h } from 'vue';
import { Quasar } from 'quasar';
import quasarLang from 'quasar/lang/fr';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import { Notify } from 'quasar';

import '@quasar/extras/material-icons/material-icons.css'
import 'quasar/src/css/index.sass'

import AppLayout from './Layouts/AppLayout.vue';

createInertiaApp({
    resolve: name => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Quasar, {
                plugins: { Notify },
                lang: quasarLang,
                config: {
                    notify: {
                        position: 'top',
                    },
                }
            })
            .mount(el);
    }
})
