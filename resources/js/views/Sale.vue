<template>
    <breadcrumb-component folder="Ventas" subfolder="Ventas"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Ventas
                <router-link v-show="btnCreate" :to="{ name: 'sale.create' }" class="btn btn-secondary"><i class="icon-plus"></i> Nuevo</router-link>
            </div>
            <div class="card-body">
                <search-component @search="findSale" />
                <table-component :data="sales"  @load="loadSale" />
                <pagination-component name="sale" :pagination="pagination" />
            </div>
        </div>
    </div>

    <delete-component title="Venta" :data="sale" @delete="destroySale"  />
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/Sale/TableComponent";
import DeleteComponent from "../components/Sale/DeleteComponent";
import SearchComponent from "../components/Sale/SearchComponent";
import {computed, ref, watch} from "vue";
import {useSale} from "../composables/useSale";
import {useToast} from "../composables/useToast";
export default {
    name: "Sale",
    components: {
        BreadcrumbComponent,
        TableComponent,
        DeleteComponent,
        SearchComponent
    },
    setup(){
      const sale = ref([]);

      const {getSales, pagination, sales, route, deleteSale} = useSale();
      const {successToast} = useToast();
      const permissions = localStorage.getItem('permissions');
      const btnCreate = computed(() => {return permissions.includes('sale.create')})

      const loadSale = (data) => {
        sale.value = { ...data};
      }

      const findSale = async (condition, search) => {
          await getSales(search, condition);
      }

      const destroySale = async (id) => {
        await deleteSale(id);
        await getSales();
        successToast('Eliminado');
      }

      getSales();

      watch(() => route.query.page, ()=>{
         return getSales();
      })

      return { sales, pagination, loadSale, sale, destroySale, findSale, btnCreate};
    }
}
</script>

<style scoped>

</style>
