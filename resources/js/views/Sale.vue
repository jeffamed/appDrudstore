<template>
    <breadcrumb-component folder="Ventas" subfolder="Ventas"/>
    <table-component title="Ventas" />
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
