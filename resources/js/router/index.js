import { createRouter, createWebHistory }  from  "vue-router"

const routes = [
    {
        path:'/',
        name:'home',
        component : import(/* webpackChunkName: "home"*/'../components/ExampleComponent')
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
