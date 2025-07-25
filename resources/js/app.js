import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import helperMixin from '../helpers/helpers'; // se você tiver mixins personalizados
import { ZiggyVue } from 'ziggy-js';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
    return pages[`./Pages/${name}.vue`];
  },

  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mixin(helperMixin)
      .use(ZiggyVue)
      .component('Link', Link)
      .mount(el); // el = #app
  },
  
});
