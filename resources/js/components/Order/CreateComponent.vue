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
                <vue-select v-model="supplier" :options="suppliers" label-by="name" placeholder="Seleccione el proveedor" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
            </div>
            <div class="col-md-4">
                <label class="ml-3 form-control-label" for="name">Teléfono</label>
                <input type="text" name="name" class="form-control bg-white" placeholder="Telefono del provedor" disabled v-model="detailsSupplier.phone">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <label class="ml-3 form-control-label" for="name">Dirección</label>
                <input type="text" name="name" class="form-control bg-white" placeholder="Direccion del proveedor" disabled v-model="detailsSupplier.address">
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
                    <input type="text" name="product" id="txtpCode" class="form-control" placeholder="00000X + Enter" v-model.trim="search" @keydown.enter="search == null || search === '' ? modalProduct() : searchProd('code')" >
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalProducto" id="modalProduct"><i class="icon-settings"></i></button>
                </div>
                <span class="help-block text-danger" id="errorCode" style="display: none">(*) Busque un producto segun el codigo.</span>
            </div>
            <div class="col-md-7">
                <label class="ml-3 form-control-label" for="product">Nombre</label>
                <input type="text" name="product" id="txtPName" class="form-control bg-white" placeholder="Nombre del Producto + Presentacion" disabled>
            </div>
            <div class="col-md-2">
                <label class="ml-3 form-control-label" for="product">Stock Act.</label>
                <input type="text" name="product" id="txtPStock" class="form-control bg-white" placeholder="00" disabled>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-3">
                <label class="ml-3 form-control-label" for="cantidad">Cant. Comprada</label>
                <input type="number" name="cantidad" id="txtOrderQty" class="form-control" placeholder="00" v-model.number="form.orderQty">
                <span class="help-block text-danger" id="errorQty" style="display: none">(*) La cantidad no puede ser cero</span>
            </div>
            <div class="col-md-4">
                <label class="ml-3 form-control-label" for="precio">Precio</label>
                <input type="number" name="comprada" id="precio" step="0.01" class="form-control" placeholder="00.00" v-model.number="form.unitPrice">
                <span class="help-block text-danger" id="errorPrice" style="display: none">(*) La precio no puede ser cero</span>

            </div>
            <div class="col-md-3">
                <label class="ml-3 form-control-label" for="descuento">Descuento</label>
                <input type="number" name="descuento" id="descuento" step="0.01" class="form-control" placeholder="00.00" v-model.number="form.discount">
            </div>
            <div class="col-md-1 mx-auto mt-4">
                <button class="btn btn-success" @click="addDetails">Agregar</button>
            </div>
            <!--table-->
            <div class="col-md-12 mt-3">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th width="5%">Eliminar</th>
                            <th>Cod</th>
                            <th>Producto</th>
                            <th class="text-center">Cant.</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Desc.</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="detailsOrder.length" v-for="(detail, index) in detailsOrder" :key="index">
                            <td width="5%" class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" @click="remove(index)">
                                    <i class="icon-close"></i>
                                </button>
                            </td>
                            <td>{{ detail.code }}</td>
                            <td width="40%">{{ detail.product }}</td>
                            <td class="text-center" >{{ detail.orderQty }}</td>
                            <td class="text-center" > {{ detail.unitPrice }}</td>
                            <td class="text-center" >{{ detail.discount }}</td>
                            <td class="text-center" > {{ (detail.unitPrice * detail.orderQty) - detail.discount }}</td>
                        </tr>
                        <tr v-else>
                            <td colspan="7" class="text-center">No se ha registrado ningun producto...</td>
                        </tr>
                    </tbody>
                    <tfoot class="border-top">
                        <tr v-show="detailsOrder.length">
                            <td colspan="3" class="font-weight-bold">Total Productos Registrados: {{ total }}</td>
                            <td class="text-center">{{ totalQty }}</td>
                            <td class="text-center"></td>
                            <td class="text-center">{{ totalDiscount }}</td>
                            <td class="text-center font-weight-bold bg-success text-white">{{ totalOrder }}</td>
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
                            <label class="form-control-label" for="name">Producto</label>
                            <div class="d-flex">
                                <input type="text" name="name" class="form-control" placeholder="Buscar por nombre" id="txtSearchProd" v-model.trim="search" @keydown.enter="searchProd('name')">
                                <button class="btn btn-sm btn-outline-secondary" @click="searchProd('name')"><i class="icon-magnifier"></i></button>
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
                                    <tr v-if="products.length" v-for="(product, index) in products" :key="index">
                                        <td>{{ product.code }}</td>
                                        <td width="50%">{{ product.name }} Pres.: {{ product.presentation.name }}</td>
                                        <td width="10%" height="42px" class="p-0"><input class="border-0 inputTable" type="number" v-model="product.qtyOrder"> </td>
                                        <td width="13%" height="42px" class="p-0"><input class="border-0 inputTable" type="number" step="0.01" v-model="product.costOrder"></td>
                                        <td width="12%" height="42px" class="p-0"><input class="border-0 inputTable" type="number" step="0.01" v-model="product.discountOrder"></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-sm" @click="addProd(product)">
                                                <i class="icon-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="6" class="text-center">Producto no encontrado</td>
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
import {computed, reactive, ref, watch} from "vue";
import VueSelect from 'vue-next-select';
import 'vue-next-select/dist/index.min.css';
import {useSuppliers} from "../../composables/useSuppliers";
import {useProducts} from "../../composables/useProducts";
import {useToast} from "../../composables/useToast";
export default {
    name: "CreateComponent",
    components:{
        VueSelect
    },
    setup(){
        const form = reactive({
            orderQty: 0,
            unitPrice: 0,
            discount: 0,
        });
        const supplier = ref([]);
        const detailsSupplier = reactive({
            phone: '',
            address: ''
        })
        const detailsOrder = ref([]);
        const search = ref('');
        const errorForm = ref(false);
        const total = computed(()=>{
            let sum = 0;
            sum = sum + detailsOrder.value.length;

            return sum;
        });
        const totalOrder = computed(() => {
            let sum = 0;
            for (let i = 0; i < detailsOrder.value.length; i++) {
                sum = parseFloat(sum) + (parseFloat(detailsOrder.value[i].orderQty * detailsOrder.value[i].unitPrice) - detailsOrder.value[i].discount );
            }
            return sum.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        });
        const totalQty = computed(() => {
            let sum = 0;
            for (let i = 0; i < detailsOrder.value.length; i++) {
                sum = parseFloat(sum) + parseFloat(detailsOrder.value[i].orderQty);
            }
            return sum.toFixed(2);
        });
        const totalDiscount = computed(() => {
            let sum = 0;
            for (let i = 0; i < detailsOrder.value.length; i++) {
                sum = parseFloat(sum) + parseFloat(detailsOrder.value[i].discount);
            }
            return sum.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        });

        const {allSuppliers, suppliers} = useSuppliers();
        const {searchProduct, products} = useProducts();
        const {errorToast} = useToast();

        const modalProduct = () => {
            $('#modalProducto').on('shown.bs.modal', function () {
                $("#txtSearchProd").focus();
            })
            $("#modalProduct").click();
        }

        const searchProd = async (condition) => {
            await searchProduct(condition, search.value);
            await products;
            if (condition != 'name'){
                if (products.value["code"] !== undefined){
                    $("#txtPName").val(products.value.name+" - Pres.: "+ products.value.presentacion);
                    $("#txtPStock").val(products.value.stock);
                    $("#txtOrderQty").focus().select();
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Producto no fue encontrado, verifique.',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    $("#txtPName").val('');
                    $("#txtPStock").val('');
                }
            }
        }

        const addDetails = () => {
            if (validateForm()){
                return;
            }
            if(verify(products.value.id)){
                Swal.fire({
                    title: 'Error...',
                    text: "Lo sentimos, ya tiene registrado el producto",
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000,
                })
            }else{
                form.product_id = products.value.id;
                form.code = products.value.code;
                form.product = $("#txtPName").val();
                detailsOrder.value.push( { ...form } );
                clearProduct();
                $("#txtpCode").focus();
            }
        }

        const addProd = (product) => {
            if (verify(product.id)){
                Swal.fire({
                    title: 'Error...',
                    text: "Lo sentimos, ya tiene registrado el producto",
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1000,
                })
            }else{
                let data = {
                    'product_id': product.id,
                    'code' : product.code,
                    'discount' : product.discountOrder,
                    'orderQty' : product.qtyOrder,
                    'unitPrice' : product.costOrder,
                    'product' : product.name + " - Pres.:" + product.presentation.name
                };

                detailsOrder.value.push( data );
                search.value = '';
                $("#txtSearchProd").focus();
                products.value = [];
            }
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
            form.orderQty = 0;
            form.unitPrice = 0;
            form.discount = 0;
            $("#txtPName").val('');
            $("#txtPStock").val('');
        }

        const verify = (id) => {
            var temp = false;
            for (let i = 0; i < detailsOrder.value.length; i++) {
                if (detailsOrder.value[i].product_id == id) {
                    return temp=true;
                }
            }
            return temp;
        }

        const validateForm = () => {
            let error = false;
            hideError();

            let product =  $("#txtPName").val();
            if (product == ""){
                errorToast();
                $("#errorCode").show();
                error = true;
            }else if (form.orderQty == 0){
                errorToast();
                $("#errorQty").show();
                error = true;
            }else if (form.unitPrice == 0){
                errorToast();
                $("#errorPrice").show();
                error = true;
            }
            errorForm.value = error;

            return errorForm.value;

        }

        const hideError = () => {
            $("#errorCode").hide();
            $("#errorQty").hide();
            $("#errorPrice").hide();
        }

        allSuppliers();

        watch(supplier, () => {
            detailsSupplier.phone = supplier.value.phone,
            detailsSupplier.address = supplier.value.address
        });

        return {form, products, detailsOrder, suppliers, supplier, detailsSupplier, search, clearProduct, modalProduct, searchProd, addDetails, addProd, remove, totalOrder, totalQty, totalDiscount, total }

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
