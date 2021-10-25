<template>
    <breadcrumb-component folder="Almacén" subfolder="Ubicación"/>
    <table-component title="Ubicación" />
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
export default {
    name: "Location",
    components: {
        BreadcrumbComponent,
        TableComponent
    }
}
</script>

<style scoped>

</style>
