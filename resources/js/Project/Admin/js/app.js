import '../../../bootstrap';
import router from './router';
import "bootstrap/dist/css/bootstrap.min.css"

// import { createApp } from 'vue'; // for simple vue 

import { createApp } from 'vue/dist/vue.esm-bundler'; // for using 
import IndexComponent from '../index.vue'

const app = createApp({});
app.component('index-component', IndexComponent);
app.use(router);
app.mount('#app');