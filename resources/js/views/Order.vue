<template>
    <breadcrumb-component folder="Compras" subfolder="Ingresos"/>
    <table-component title="Ingresos" />
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
