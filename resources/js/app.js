import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { createPinia } from "pinia";
import Vue3Toastify from "vue3-toastify";
import VueApexCharts from "vue3-apexcharts";

import "vue3-toastify/dist/index.css";
import './echo';


const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Vue3Toastify, {
                theme: "dark",
                hideProgressBar: true,
                transition: "flip",
                autoClose: 2000,
            })
            .use(createPinia());

        app.component('apexchart', VueApexCharts);

        return app.mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
