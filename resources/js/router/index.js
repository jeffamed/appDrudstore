import { createRouter, createWebHistory }  from  "vue-router"

const routes = [
    {
        path:'/',
        name:'home',
        component : import(/* webpackChunkName: "routes"*/'../components/ExampleComponent')
    },
    {
        path:'/cliente',
        name:'customer',
        component : import(/* webpackChunkName: "routes"*/'../views/Customer')
    },
    {
        path:'/laboratorio',
        name:'laboratory',
        component : import(/* webpackChunkName: "routes"*/'../views/Laboratory')
    },
    {
        path:'/ubicacion',
        name:'location',
        component : import(/* webpackChunkName: "routes"*/'../views/Location')
    },
    {
        path:'/compras',
        name:'order',
        component : import(/* webpackChunkName: "routes"*/'../views/Order')
    },
    {
        path:'/compras/crear',
        name:'order.create',
        component : import(/* webpackChunkName: "routes"*/'../components/Order/CreateComponent')
    },
    {
        path:'/presentacion',
        name:'presentation',
        component : import(/* webpackChunkName: "routes"*/'../views/Presentation')
    },
    {
        path:'/productos',
        name:'product',
        component : import(/* webpackChunkName: "routes"*/'../views/Product')
    },
    {
        path:'/productos/crear',
        name:'product.create',
        component : import(/* webpackChunkName: "routes"*/'../components/Product/CreateComponent')
    },
    {
        path:'/productos/:id/editar',
        name:'product.edit',
        props: true,
        component : import(/* webpackChunkName: "routes"*/'../components/Product/EditComponent')
    },
    {
        path:'/ventas',
        name:'sale',
        component : import(/* webpackChunkName: "routes"*/'../views/Sale')
    },
    {
        path:'/ventas/crear',
        name:'sale.create',
        component : import(/* webpackChunkName: "routes"*/'../components/Sale/CreateComponent')
    },
    {
        path:'/proveedor',
        name:'supplier',
        component : import(/* webpackChunkName: "routes"*/'../views/Supplier')
    },
    {
        path:'/tipo-producto',
        name:'type',
        component : import(/* webpackChunkName: "routes"*/'../views/Type')
    },
    {
        path:'/uso',
        name:'usage',
        component : import(/* webpackChunkName: "routes"*/'../views/Usage')
    },
    {
        path:'/:pathMatch(.*)*',
        component : import(/* webpackChunkName: "routes"*/'../views/404')
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
