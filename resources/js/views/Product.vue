<template>
    <breadcrumb-component folder="Almacén" subfolder="Productos"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Productos
                <router-link v-if="btnCreate" :to="{ name: 'product.create' }" class="btn btn-secondary"><i class="icon-plus"></i> Nuevo</router-link>
                <button class="btn btn-sm btn-success float-right" @click="download"><span class="icon-cloud-download"></span></button>
            </div>
            <div class="card-body">
                <search-component @search="findProduct" />
                <table-component :data="products" @load="loadProduct"/>
                <pagination-component name="product" :pagination="pagination"/>
            </div>
        </div>
    </div>

    <delete-component  title="Productos" body="el producto" :data="product" @delete="destroyProduct" />

    <!--Inicio del modal bonificaciones-->
    <div class="modal fade" id="modalBonificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-secondary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Bonificación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="addBonus">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <p>El producto <b>{{ product.name }}</b> recibira bonificación</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-label" for="bonus">Cantidad: </label>
                            <div class="col-md-9">
                                <input type="number" name="bonus" class="form-control" placeholder="00" v-model="bonus">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="modalClose" data-dismiss="modal" @click="clear">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->

</template>

<script>
import TableComponent from "../components/Product/TableComponent";
import SearchComponent from "../components/Product/SearchComponent";
import {computed, onMounted, ref, watch} from "vue";
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
        const bonus = ref(0);
        const {getProducts, products, pagination, deleteProduct, route} = useProducts();
        const {successToast} = useToast();
        const permissions = localStorage.getItem('permissions');
        const btnCreate = computed(() => {return permissions.includes('product.create')})

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

        const download = () => {
            axios({ url: '/api/all_product', method: 'GET', responseType: 'blob'})
            .then(response=>{
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'Inventario.pdf');
                document.body.appendChild(link);
                link.click();
            });
        }

        const addBonus = () => {
            let bonif = {
                cantidad : bonus.value
            }
            axios.put(`api/bonus/${product.value.id}`, bonif).
            then(async (response) => {
                 await getProducts();
                 bonus.value = 0;
                 await successToast('Bonificación agregada');
                 $('#modalClose').click();
            })
        }

        watch( () => route.query.page, ()=>{
            getProducts();
        });

        onMounted(getProducts);

        return {products, bonus, pagination, product, loadProduct, destroyProduct, findProduct, btnCreate, download, addBonus}
    }
}
</script>

<style scoped>

</style>
