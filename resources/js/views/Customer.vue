<template>
    <breadcrumb-component folder="Ventas" subfolder="Clientes"/>
    <table-component title="Clientes" />
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
export default {
    name: "Customer",
    components: {
        BreadcrumbComponent,
        TableComponent
    }
}
</script>

<style scoped>

</style>
