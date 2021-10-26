<template>
    <breadcrumb-component folder="Almacén" subfolder="Laboratorios"/>
    <table-component title="Laboratorios" />
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
export default {
    name: "Laboratory",
    components: {
        BreadcrumbComponent,
        TableComponent
    }
}
</script>

<style scoped>

</style>
