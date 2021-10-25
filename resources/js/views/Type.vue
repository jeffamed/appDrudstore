<template>
    <breadcrumb-component folder="Almacén" subfolder="Tipos"/>
    <table-component title="Tipos de Productos" />
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
export default {
    name: "Type",
    components: {
        BreadcrumbComponent,
        TableComponent
    }
}
</script>

<style scoped>

</style>
