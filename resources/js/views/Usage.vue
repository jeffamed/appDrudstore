<template>
    <breadcrumb-component folder="Almacén" subfolder="Usos"/>
    <table-component title="Usos" />
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
export default {
    name: "Usage",
    components:{
        BreadcrumbComponent,
        TableComponent
    }
}
</script>

<style scoped>

</style>
