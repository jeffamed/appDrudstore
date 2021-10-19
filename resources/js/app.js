require('./bootstrap');

import { createApp } from "vue";
import router from './router';
import ExampleComponent from "./components/ExampleComponent";

createApp({
    components: {
        ExampleComponent
    }
}).use(router).mount('#app');
