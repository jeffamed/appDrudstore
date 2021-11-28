<template>
    <breadcrumb-component folder="Ventas" subfolder="Ventas"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Ventas
                <router-link :to="{ name: 'sale.create' }" class="btn btn-secondary"><i class="icon-plus"></i> Nuevo</router-link>
            </div>
            <div class="card-body">
                <table-component title="Ventas" />
                <pagination-component name="order" :pagination="pagination" />
            </div>
        </div>
    </div>
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
export default {
    name: "Sale",
    components: {
        BreadcrumbComponent,
        TableComponent
    }
}
</script>

<style scoped>

</style>
