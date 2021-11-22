<template>
    <breadcrumb-component folder="Almacén" subfolder="Compras   /   Crear"/>
    <div class="row col-md-12 justify-content-center">
        <h5>Registrar Compra</h5>
    </div>
    <!--Formulario de proveedor-->
    <div class="container pb-1 pt-2 shadow b-white">
        <p>Información del Proveedor</p>
        <div class="row form-group">
            <div class="col-md-8">
                <label class="ml-3 form-control-label" for="name">Nombre</label>
                <vue-select v-model="order.supplier_id" :options="suppliers" label-by="name" value-by="id" placeholder="Seleccione el proveedor" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
            </div>
            <div class="col-md-4">
                <label class="ml-3 form-control-label" for="name">Teléfono</label>
                <input type="text" name="name" class="form-control bg-white" placeholder="Telefono del provedor" disabled>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <label class="ml-3 form-control-label" for="name">Dirección</label>
                <input type="text" name="name" class="form-control bg-white" placeholder="Direccion del proveedor" disabled>
            </div>
        </div>
    </div>
    <!--Formulario de producto-->
    <div class="container pb-1 pt-2 mb-3 shadow mt-1 bg-white">
        <p>Información del Producto</p>
        <div class="row form-group">
            <div class="col-md-3">
                <label class="ml-3 form-control-label" for="product">Buscar por Codigo</label>
                <div class="d-flex">
                    <input type="text" name="product" id="product" class="form-control" placeholder="00000X + Enter" v-model.trim="search" @keydown.enter="search == null || search === '' ? modalProduct() : searchProd('code')" >
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalProducto" id="modalProduct"><i class="icon-settings"></i></button>
                </div>
            </div>
            <div class="col-md-7">
                <label class="ml-3 form-control-label" for="product">Nombre</label>
                <input type="text" name="product" id="product-name" class="form-control bg-white" placeholder="Nombre del Producto" disabled v-model="product.name">
            </div>
            <div class="col-md-2">
                <label class="ml-3 form-control-label" for="product">Stock Act.</label>
                <input type="text" name="product" id="product-stock" class="form-control bg-white" placeholder="00" disabled v-model="product.stock">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3">
                <label class="ml-3 form-control-label" for="cantidad">Cant. Comprada</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="00" v-model="product.quantity">
            </div>
            <div class="col-md-4">
                <label class="ml-3 form-control-label" for="precio">Precio</label>
                <input type="number" name="comprada" id="precio" step="0.01" class="form-control" placeholder="00.00" v-model="product.cost">
            </div>
            <div class="col-md-3">
                <label class="ml-3 form-control-label" for="descuento">Descuento</label>
                <input type="number" name="descuento" id="descuento" step="0.01" class="form-control" placeholder="00.00" v-model="product.discount">
            </div>
            <div class="col-md-1 mx-auto mt-4">
                <button class="btn btn-success" @click="addDetails">Agregar</button>
            </div>
            <!--table-->
            <div class="col-md-12 mt-3">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Eliminar</th>
                            <th>Cod</th>
                            <th>Producto</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Cant.</th>
                            <th class="text-center">Desc.</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="detailsOrder" v-for="(detail, index) in detailsOrder" :key="index">
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" @click="remove(index)">
                                    <i class="icon-close"></i>
                                </button>
                            </td>
                            <td>{{ detail.code }}</td>
                            <td width="40%">{{ detail.name }}</td>
                            <td class="text-center" >25.90</td>
                            <td class="text-center" >100</td>
                            <td class="text-center" >0.00</td>
                            <td class="text-center" >2590</td>
                        </tr>
                        <tr v-else>
                            <td colspan="6" class="text-center">No hay datos Registrados</td>
                        </tr>
                    </tbody>
                    <tfoot class="border-top">
                        <tr>
                            <td colspan="4" class="font-weight-bold">Total</td>
                            <td class="text-center">100</td>
                            <td class="text-center">0</td>
                            <td class="text-center font-weight-bold bg-success text-white">2590</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="form-group d-flex justify-content-end">
            <button class="btn btn-success mr-2">Guardar</button>
            <router-link class="btn btn-danger" :to="{ name : 'order' }">Cancelar</router-link>
        </div>
    </div>

    <!--Buscar producto por nombre-->
    <div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-success modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Buscar Producto</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="clearProduct">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">Producto</label>
                            <div class="d-flex">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Buscar por nombre" v-model="search" @keydown.enter="searchProd('nombre')">
                                <button class="btn btn-sm btn-outline-secondary" @click="searchProd('nombre')"><i class="icon-magnifier"></i></button>
                            </div>

                        </div>
                        <div class="col-md-12 mt-3" style="overflow: auto; max-height: 40%">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Cod</th>
                                    <th>Producto</th>
                                    <th class="text-center">Cant.</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Desc.</th>
                                    <th class="text-center">Agr.</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="1 === 1">
                                        <td>00001</td>
                                        <td width="50%">Producto encontrado 00001</td>
                                        <td width="10%" height="42px" class="p-0"><input class="border-0 inputTable" type="number" value="0"> </td>
                                        <td width="13%" height="42px" class="p-0"><input class="border-0 inputTable" type="number" step="0.01" value="00.00"></td>
                                        <td width="12%" height="42px" class="p-0"><input class="border-0 inputTable" type="number" step="0.01" value="00.00"></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-sm" @click="addDetails">
                                                <i class="icon-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="5" class="text-center">Producto no encontrado</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</template>
<script>
import Swal from "sweetalert2";
import {reactive, ref} from "vue";
import VueSelect from 'vue-next-select';
import 'vue-next-select/dist/index.min.css';
import {useSuppliers} from "../../composables/useSuppliers";
export default {
    name: "CreateComponent",
    components:{
        VueSelect
    },
    setup(){
        const product = reactive({
            id: '',
            code: '',
            name: '',
            stock: 0,
            cost: 0,
            quantity: 0,
            discount: 0,
        });
        const details = reactive({
            code: 0,
            product: '',
            product_id: 0,
            orderQty: 0,
            unitPrice: 0,
            discount: 0,
            total: 0,
        });
        const order = reactive({
            supplier_id: 0,
        })
        const detailsOrder = ref([]);

        const search = ref('');

        const {allSuppliers, suppliers} = useSuppliers();

        const modalProduct = () => {
            $("#modalProduct").click();
        }

        const searchProd = (search) => {
            console.log(`${search} Producto Encontrado`);
        }

        const addDetails = () => {
            detailsOrder.value.push( { ...product } );
            console.log(product);
            clearProduct();
        }

        const remove = (index) => {
            Swal.fire({
                title: '¿Estas Seguro?',
                text: "No podra ser capaz de revertir esta operación!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    detailsOrder.value.splice(index, 1);
                    Swal.fire(
                        'Eliminado',
                        'El producto fue eliminado de su compra',
                        'success'
                    )
                }
            })
        }

        const clearProduct = () => {
            search.value = '';
            product.id = '';
            product.code = '';
            product.name = '';
            product.stock = 0;
            product.cost = 0;
            product.quantity = 0;
            product.discount = 0;
        }

        allSuppliers();

        return {product, details, detailsOrder, order, suppliers, search, clearProduct, modalProduct, searchProd, addDetails, remove }

    }
}
</script>

<style scoped>
    .shadow{
        border: 0.2px solid hsl(0, 10%, 80%);
        border-radius: 5px;
        box-shadow: 7px 6px 6px 1px rgba(0,0,0,0.30);
        -webkit-box-shadow: 7px 6px 6px 1px rgba(0,0,0,0.30);
        -moz-box-shadow: 7px 6px 6px 1px rgba(0,0,0,0.30);
    }
    .b-white{
        background: #ffffff;
    }
    .breadcrumb{
        margin-bottom: 0.5rem;
    }
    .inputTable{
        width:100%;
        height: 100%;
        background: #f2f2f2;
        text-align: center;
    }
</style>
