require('./bootstrap');

import { createApp } from "vue";
import router from './router';
import App from "./App.vue";
import DeleteComponent from "./components/DeleteComponent";
import BreadcrumbComponent from "./components/BreadcrumbComponent";
import PaginationComponent from "./components/PaginationComponent";
import axios from "axios";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App);

/*componente importados de manera global*/
app.component('DeleteComponent', DeleteComponent);
app.component('BreadcrumbComponent', BreadcrumbComponent);
app.component('PaginationComponent', PaginationComponent);
app.use(router,axios,VueSweetalert2).mount('#app');
