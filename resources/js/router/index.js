import { createRouter, createWebHistory }  from  "vue-router"

import ExampleComponent from "../components/ExampleComponent";

const routes = [
    {
        path:'/',
        name:'home',
        component : ExampleComponent
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
