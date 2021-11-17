<template>
    <breadcrumb-component folder="Almacén" subfolder="Productos"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Productos
                <router-link :to="{ name: 'product.create' }" class="btn btn-secondary"><i class="icon-plus"></i> Nuevo</router-link>
            </div>
            <div class="card-body">
                <search-component @search="findProduct" />
                <table-component :data="products" @load="loadProduct"/>
                <pagination-component name="product" :pagination="pagination"/>
            </div>
        </div>
    </div>

    <delete-component  title="Productos" :data="product" @delete="destroyProduct" />

</template>

<script>
import TableComponent from "../components/Product/TableComponent";
import SearchComponent from "../components/Product/SearchComponent";
import {onMounted, ref} from "vue";
import {useProducts} from "../composables/useProducts";
import {useToast} from "../composables/useToast";
export default {
    name: "Product",
    components: {
        SearchComponent,
        TableComponent
    },
    setup(){
        const product = ref([]);
        const {getProducts, products, pagination, deleteProduct} = useProducts();
        const {successToast} = useToast();

        const loadProduct = async (data) => {
            product.value = { ...data };
        }

        const findProduct = async(condition, search) => {
            await getProducts(condition, search);
        }

        const destroyProduct = async (id) => {
            await deleteProduct(id);
            await getProducts();
            await successToast('Eliminado');
        }

        onMounted(getProducts);

        return {products, pagination, product, loadProduct, destroyProduct, findProduct}
    }
}
</script>

<style scoped>

</style>
