import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import  Layout from './Shared/Layout'
import { InertiaProgress } from '@inertiajs/progress'
import Helper from './Shared/packages/Helper.vue'

// import CKEditor from 'ckeditor4-vue';
import CKEditor from '@ckeditor/ckeditor5-vue';

// Vue.use( CKEditor );

InertiaProgress.init()
createInertiaApp({
  resolve: name => {
    const page = require(`./Pages/${name}`)
    page.layout = page.layout || Layout
    return page; 
  },
  setup({ el, App, props, plugin }) {

    createApp({ render: () => {
    return   h(App, props)
       }})
      .use(plugin)
      .use(CKEditor)
      .mixin({methods: { route,error(field, errorBag = 'default') {
       
        if (this.$page.props.errors.hasOwnProperty(field)) {
          return this.$page.props.errors[field];
        }
        if (!this.$page.props.errors.hasOwnProperty(errorBag)) {
          return null;
        }
        return null;
      },clearParams(filters) {
        const params = {};
        if (filters.page > 1) params.page = filters.page;
        Object.keys(filters).forEach((column) => {
            if (filters[column] && column != 'page') {
                params[column] = filters[column];
            }
        });
        return params;
    }, clone(obj) {
      return JSON.parse(JSON.stringify(obj));
  },back(){
      return       window.history.back();
    } }, Helper
    })
      .mount(el)
  },
})