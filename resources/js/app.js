/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp, h } from 'vue';
import { Quasar } from 'quasar';
import quasarLang from 'quasar/lang/fr';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';


import '@quasar/extras/material-icons/material-icons.css'
import 'quasar/src/css/index.sass'

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

createInertiaApp({
    resolve: name => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Quasar, {
                plugins: {},
                lang: quasarLang,
            })
            .mount(el);
    }
})
