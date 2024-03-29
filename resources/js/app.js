import './bootstrap';

import { createApp } from "vue/dist/vue.esm-bundler";
import PostIndex from "../views/components/post/index.vue"



const app = createApp({});
app.component('post-index',PostIndex);
app.mount('#app')
