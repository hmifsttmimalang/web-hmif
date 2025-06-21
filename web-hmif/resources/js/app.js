import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import './bootstrap'

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "bootstrap-icons/font/bootstrap-icons.css";
import "aos/dist/aos.css";
import "bootstrap";
import "../css/app.css";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) })
            .use(plugin);

        // Init eksternal plugin setelah mount
        import('aos').then(AOS => {
            AOS.init();
        });
        import('@srexi/purecounterjs').then(({ default: PureCounter }) => {
            new PureCounter();
        });

        vueApp.mount(el);
    },
})
