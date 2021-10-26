<template>
    <breadcrumb-component folder="Almacén" subfolder="Presentación"/>
    <table-component title="Presentación" :data="presentations" :pagination="pagination"/>
    <pre>{{ pagination }}</pre>
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
import { usePresentations } from '../composables/usePresentations'
import { onMounted, ref } from "vue";
export default {
    name: "Presentation",
    components: {
        BreadcrumbComponent,
        TableComponent
    },
    setup(){
        return { ...usePresentations() };

    }
}
</script>

<style scoped>

</style>
