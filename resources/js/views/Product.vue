<template>
    <breadcrumb-component folder="Almacén" subfolder="Productos"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Productos
                <router-link :to="{ name: 'product.create' }" class="btn btn-secondary"><i class="icon-plus"></i> Nuevo</router-link>
            </div>
            <div class="card-body">
                <table-component title="Productos" />
            </div>
        </div>
    </div>

</template>

<script>
import TableComponent from "../components/Product/TableComponent";
import {reactive} from "vue";
export default {
    name: "Product",
    components: {
        TableComponent
    },
    setup(){
        const form = reactive({

        })

        const save = async () => {
        }

        return {form, save}
    }
}
</script>

<style scoped>

</style>
