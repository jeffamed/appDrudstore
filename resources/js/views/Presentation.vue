<template>
    <breadcrumb-component folder="Almacén" subfolder="Presentación"/>
    <table-component title="Presentación" />
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
export default {
    name: "Presentation",
    components: {
        BreadcrumbComponent,
        TableComponent
    }
}
</script>

<style scoped>

</style>
