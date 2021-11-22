<template>
    <breadcrumb-component folder="Compras" subfolder="Ingresos"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Compras
                <router-link :to="{ name: 'order.create' }" class="btn btn-secondary"><i class="icon-plus"></i> Nuevo</router-link>
            </div>
            <div class="card-body">
                <table-component title="Ingresos" />
            </div>
        </div>
    </div>
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
export default {
    name: "Order",
    components: {
        BreadcrumbComponent,
        TableComponent
    }
}
</script>

<style scoped>

</style>
