<template>
    <breadcrumb-component folder="Compras" subfolder="Proveedor"/>
    <table-component title="Proveedor" />
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
export default {
    name: "Supplier",
    components: {
        BreadcrumbComponent,
        TableComponent
    }
}
</script>

<style scoped>

</style>
