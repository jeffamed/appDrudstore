<template>
    <breadcrumb-component folder="Ventas" subfolder="Ventas"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Ventas
                <router-link :to="{ name: 'sale.create' }" class="btn btn-secondary"><i class="icon-plus"></i> Nuevo</router-link>
            </div>
            <div class="card-body">
                <table-component :data="sales"  @load="loadSale" />
                <pagination-component name="sale" :pagination="pagination" />
            </div>
        </div>
    </div>
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/Sale/TableComponent";
import {ref, watch} from "vue";
import {useSale} from "../composables/useSale";
import {useToast} from "../composables/useToast";
export default {
    name: "Sale",
    components: {
        BreadcrumbComponent,
        TableComponent
    },
    setup(){
      const sale = ref([]);

      const {getSales, pagination, sales, route, deleteSale} = useSale();
      const {successToast} = useToast();

      const loadSale = (data) => {
        sale.value = { ...data};
      }

      const destroySale = async (id) => {
        await deleteSale(id);
        await getSales();
        successToast('Eliminado');
      }

      getSales();

      watch(() => route.query.page, ()=>{
         return getOrders();
      })

      return { sales, pagination, loadSale, sale, deleteSale};
    }
}
</script>

<style scoped>

</style>
