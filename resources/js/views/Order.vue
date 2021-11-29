<template>
    <breadcrumb-component folder="Compras" subfolder="Ingresos"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Compras
                <router-link :to="{ name: 'order.create' }" class="btn btn-secondary"><i class="icon-plus"></i> Nuevo</router-link>
            </div>
            <div class="card-body">
                <search-component @search="findOrder" />
                <table-component :data="orders"  @load="loadOrder" />
                <pagination-component name="order" :pagination="pagination" />
            </div>
        </div>
    </div>

    <delete-component title="Compra" :data="order" @delete="destroyOrder"  />
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/Order/TableComponent";
import DeleteComponent from "../components/Order/DeleteComponent";
import {useOrder} from "../composables/useOrder";
import {ref, watch} from "vue";
import {useToast} from "../composables/useToast";
import SearchComponent from "../components/Order/SearchComponent";
export default {
    name: "Order",
    components: {
        SearchComponent,
        BreadcrumbComponent,
        TableComponent,
        DeleteComponent
    },
    setup(){
        const order = ref([]);

        const {getOrders, pagination, orders, route, deleteOrder} = useOrder();
        const { successToast } = useToast();

        const loadOrder = (data) => {
            order.value = { ...data };
        }

        const findOrder = async(condition, search) => {
            await getOrders(search, condition);
        }

        const destroyOrder = async(id) =>{
            await deleteOrder(id);
            await getOrders();
            successToast('Eliminado')
        };

        getOrders();

        watch(() => route.query.page, ()=>{
            return getOrders();
        })

        return {orders, pagination, loadOrder, order, destroyOrder, findOrder}
    }
}
</script>

<style scoped>

</style>
