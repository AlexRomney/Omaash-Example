require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/vue3';

createInertiaApp({
  progress: {
    color: '#3A5DA8',
  },
  resolve: (name) => require(`./Pages/${name}`).default,
  setup({ el, App, props, plugin }) {
    const vueApp = createApp({ render: () => h(App, props) });

    vueApp.use(plugin);
    vueApp.mixin({ methods: { route } });
    vueApp.config.globalProperties.$methods = {
      isAdminRole: (roles) => {
        if (roles.includes('admin')) {
          return true;
        }
        return false;
      },
    };
    vueApp.config.globalProperties.$filters = {
      uppercase(value) {
        value = value.toString();
        return value.charAt(0).toUpperCase() + value.slice(1);
      },
      booleanYesNo(value) {
        const newValue = value ? 'Yes' : 'No';
        return newValue;
      },
      allCaps(value) {
        return value.toUpperCase();
      },
      allCapitalized(value) {
        const mySentence = value;
        const words = mySentence.split(' ');

        const newSentence = words
          .map((word) => {
            return word[0].toUpperCase() + word.substring(1);
          })
          .join(' ');

        return newSentence;
      },
      number(value) {
        if (!value) return 0;
        return new Intl.NumberFormat('en-US', {
          style: 'decimal',
        }).format(value);
      },
      date(value) {
        if (!value) return;
        let newDate = new Date(value.replace(/-/g, '/'));
        return new Intl.DateTimeFormat({
          dateStyle: 'short',
        }).format(newDate);
      },
      dateTimestamp(value) {
        if (!value) return;
        let newDate = new Date(Date.parse(value));
        return new Intl.DateTimeFormat({
          dateStyle: 'short',
        }).format(newDate);
      },
    };
    vueApp.component('inertia-link', Link);
    vueApp.mount(el);
  },
});
