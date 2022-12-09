import '../../../bootstrap';
import router from './router';
import "bootstrap/dist/css/bootstrap.min.css"

// import { createApp } from 'vue'; // for simple vue 

import { createApp } from 'vue/dist/vue.esm-bundler'; // for using 
import IndexComponent from '../index.vue'


// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
})


const app = createApp({});
app.component('index-component', IndexComponent);
app.use(router);
app.use(vuetify);
app.mount('#app');