<template>
    <breadcrumb-component folder="Almacén" subfolder="Compras   /   Crear"/>
    <div class="row col-md-12 justify-content-center">
        <h5>Registrar Venta</h5>
    </div>
    <!--Formulario de Cliente-->
    <div class="container pb-1 pt-2 shadow b-white">
        <div class="d-flex justify-content-between">
            <p>Información del Cliente</p>
            <div class="my-auto">
                <button class="btn btn-success btn-sm rounded-circle" data-toggle="modal" data-target="#modalNewCustomer"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <label class="ml-3 form-control-label" for="name">Buscar Cliente (Nombre o Cédula)</label>
                <Multiselect
                    v-model="customer"
                    placeholder="Ingrese el nombre del cliente"
                    :filter-results="false"
                    :min-chars="1"
                    valueProp="code"
                    noOptionsText="La lista esta vacía"
                    :resolve-on-load="false"
                    :delay="0"
                    :searchable="true"
                    :options="async function(query) {
                        return await fetchCustomer(query)
                      }"
                />
            </div>
            <div class="col-md-12 mt-3" v-if="customer.length">
                <div class="border border-secondary">
                    <p class="mb-1 ml-2"><label class="form-control-label font-weight-bold">Dirección:</label> {{detailsCustomer.address}}</p>
                    <p class="mb-1 ml-2"><label class="form-control-label font-weight-bold">Teléfono:</label> {{detailsCustomer.phone}}</p>
                    <p class="mb-1 ml-2"><label class="form-control-label font-weight-bold">Correo Electrónico:</label> {{detailsCustomer.email}}</p>
                </div>
            </div>
        </div>
    </div>
    <!--Formulario de producto-->
    <div class="container pb-1 pt-2 mb-3 shadow mt-1 bg-white">
        <p>Información del Producto</p>
        <div class="row form-group">
            <div class="col-md-3">
                <label class="form-control-label" for="product">Buscar por Código</label>
                <div class="d-flex">
                    <input type="text" name="product" id="txtpCode" class="form-control" placeholder="00000X + Enter" v-model.trim="search" @keydown.enter="search == null || search === '' ? modalProduct() : searchProd('code')" >
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalProducto" id="modalProduct"><i class="icon-settings"></i></button>
                </div>
                <span class="help-block text-danger" id="errorCode" style="display: none">(*) Busque un producto segun el código.</span>
            </div>
            <div class="col-md-7">
                <label class="form-control-label" for="product">Nombre</label>
                <input type="text" name="product" id="txtPName" class="form-control bg-white" placeholder="Nombre del Producto * Presentación" disabled>
            </div>
            <div class="col-md-2">
                <label class="form-control-label" for="txtStock">Stock Act.</label>
                <h4 class="font-weight-bold text-muted" id="txtStock"></h4>
            </div>
        </div>
        <div class="row from-group">
            <div class="col-md-3">
                <label class="form-control-label" for="txtQuantity">Cantidad</label>
                <input type="number" name="product" id="txtQuantity" class="form-control bg-white" placeholder="00" v-model.number="form.orderQty">
                <span class="help-block text-danger" id="errorQty" style="display: none">(*) La cantidad no puede ser cero</span>
            </div>
            <div class="col-md-3">
                <label class="form-control-label" for="txtPrice">Precio $</label>
                <input type="text" name="product" id="txtPrice" class="form-control" placeholder="00" disabled v-model="form.unitPrice">
            </div>
            <div class="col-md-3">
                <label class="form-control-label" for="txtDiscount">Descuento $ <small class="text-muted" v-show="maxDiscount === 0">(Producto sin descuento)</small></label>
                <input type="number" name="discount" id="txtDiscount" :class="maxDiscount === 0 ? 'form-control' : 'form-control bg-white'" placeholder="00" v-model="form.discount" :max="maxDiscount" min="0" :disabled="maxDiscount === 0">

            </div>
            <div class="d-flex align-items-end">
                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-success" @click="addDetails">Agregar</button>
                </div>
            </div>
            <span class="help-block text-danger" id="errorUpper" style="display: none">(*) La cantidad a vender no puede superar el inventario.</span>
        </div>
        <div class="row form-group">
            <!--table-->
            <div class="col-md-12 mt-3">
                <table class="table table-bordered table-striped table-sm m-0">
                    <thead>
                    <tr>
                        <th width="5%">Eliminar</th>
                        <th>Código</th>
                        <th>Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio $</th>
                        <th class="text-center">Desc. $</th>
                        <th class="text-center">Total $</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="detailsSale.length" v-for="(detail, index) in detailsSale" :key="index">
                        <td width="5%" class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" @click="remove(index)">
                                <i class="icon-close"></i>
                            </button>
                        </td>
                        <td>{{ detail.code }}</td>
                        <td width="40%">{{ detail.product }}</td>
                        <td class="text-center" >{{ detail.orderQty }}</td>
                        <td class="text-center" > {{ parseFloat(detail.unitPrice).toFixed(2) }}</td>
                        <td class="text-center" >{{ parseFloat(detail.discount).toFixed(2) }}</td>
                        <td class="text-center" > {{ parseFloat((detail.unitPrice * detail.orderQty) - detail.discount).toFixed(2) }}</td>
                    </tr>
                    <tr v-else>
                        <td colspan="7" class="text-center">No se ha registrado ningun producto...</td>
                    </tr>
                    </tbody>
                    <tfoot class="border-top">
                    <tr v-show="detailsSale.length">
                        <td colspan="3" class="font-weight-bold">Total Productos Registrados: {{ total }}</td>
                        <td class="text-center">{{ totalQty }}</td>
                        <td class="text-center"></td>
                        <td class="text-center">{{ totalDiscount }}</td>
                        <td class="text-center font-weight-bold bg-success text-white">$ {{ subtotalSale }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-4" v-show="detailsSale.length">
                <table class="table table-bordered table-striped table-sm">
                    <tr>
                        <td colspan="7" class="text-center font-weight-bold">SubTotal: </td>
                        <td class="text-center font-weight-bold">$ {{ subtotalSale }}</td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <input type="checkbox" id="checkbox" v-model.number="form.iva" class="form-check-input" true-value="12" false-value="0">
                            <label class="form-check-label pl-1" for="checkbox">IVA {{ form.iva }}%: </label>
                        </td>
                        <td class="text-center">$ {{ calcIva }}</td>
                    </tr>
                    <tr><td colspan="7" class="text-center font-weight-bold">Total:</td>
                        <td class="text-center font-weight-bold bg-success text-white">$ {{ totalSale }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
        <div class="form-group d-flex justify-content-end">
            <button class="btn btn-success mr-2" @click="save">Guardar</button>
            <router-link class="btn btn-danger" :to="{ name : 'sale' }">Cancelar</router-link>
        </div>
    </div>

    <!--Modal Buscar producto por nombre-->
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
                        <div class="col-md-12" v-if="!type">
                            <div class="d-flex">
                                <label class="form-control-label mr-5" for="txtSearchProd">Producto</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" v-model="type" id="cbType">
                                    <label for="cbType">
                                        Por Uso
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <input type="text" name="product" class="form-control" placeholder="Buscar por nombre" id="txtSearchProd" v-model.trim="search" @keydown.enter="searchProd('name')">
                                <button class="btn btn-sm btn-outline-secondary" @click="searchProd('name')"><i class="icon-magnifier"></i></button>
                            </div>
                        </div>
                        <div class="col-md-12" v-else >
                            <div class="d-flex">
                                <label for="form-control-label" style="margin-right: 2.5rem">Segun el Uso</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" v-model="type" id="cbProducto">
                                    <label for="cbProducto">
                                        Por Uso
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <vue-select v-model="usage" :options="usages" label-by="description" placeholder="Seleccione el uso del medicamento" clear-on-select close-on-select searchable class="form-control w-100"></vue-select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3" style="overflow: auto; max-height: 40%">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Cod</th>
                                    <th>Producto</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">Cant.</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Desc.</th>
                                    <th class="text-center">Agr.</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="products.length" v-for="(product, index) in products" :key="index">
                                    <td>{{ product.code }}</td>
                                    <td width="45%">{{ product.name }} * {{ product.presentation.name }}</td>
                                    <td height="42px" class="p-0"><input class="border-0 inputTable b-transparent" type="number" :style="product.stock < 10 ? 'color: red' : ''" v-model="product.stock" disabled> </td>
                                    <td width="12%" height="42px" class="p-0"><input class="border-0 inputTable b-transparent" type="number" v-model.number="product.qtyOrder"></td>
                                    <td width="13%" height="42px" class="p-0"><input class="border-0 inputTable b-transparent font-weight-bold" type="number" v-model="product.price" disabled> </td>
                                    <td width="10%" height="42px" class="p-0"><input class="border-0 inputTable b-transparent" type="number" step="0.01" v-model.number="product.discountOrder" min="0" :max="product.discount" :disabled="product.discount === 0"></td>
                                    <td width="auto" class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" @click="addProd(product)">
                                            <i class="icon-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="8" class="text-center">Producto no encontrado</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <span class="help-block text-danger" id="errorTable" style="display: none">(*) La cantidad del producto que desea registrar no puede ser cero</span>
                        <span class="help-block text-danger" id="errorTable2" style="display: none">(*) No hay suficiente inventario</span>
                        <span class="help-block text-danger" id="errorTable3" style="display: none">(*) Verifique, el descuento aplicado es mayor al permitido</span>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->

    <!--Modal Agregar Cliente-->
    <div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-success modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Cédula</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Cédula" v-model.trim="formCustomer.document">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Nombre del Cliente" v-model.trim="formCustomer.name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Apellido</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Apellido del Cliente" v-model.trim="formCustomer.last_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="txtaddress">Dirección</label>
                        <div class="col-md-9">
                            <input type="text" name="txtaddress" class="form-control" placeholder="Dirección del Cliente" v-model.trim="formCustomer.address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="txtphone">Teléfono</label>
                        <div class="col-md-9">
                            <input type="text" name="txtphone" class="form-control" placeholder="Teléfono del Cliente" v-model.trim="formCustomer.phone">
                        </div>
                    </div>
                </div>
                <span class="help-block text-danger" v-show="errorsC">(*) Debe de ingresar el nombre del cliente y su cédula</span>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" @click="saveC">Guardar</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" id="btnCloseCust" @click="clearCustomer">Cerrar</button>
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
import {useProducts} from "../../composables/useProducts";
import {useToast} from "../../composables/useToast";
import {useSale} from "../../composables/useSale";
import {useCustomer} from "../../composables/useCustomer";
import {useUsages} from "../../composables/useUsages";
import Multiselect from '@vueform/multiselect'
export default {
    name: "CreateComponent",
    components:{
        Multiselect,
        VueSelect
    },
    setup(){
        const formCustomer = reactive({
            name: '',
            last_name: '',
            phone: '',
            address: '',
            document: '',
        });
        const errorsC = ref(false);
        const detailsCustomer = reactive({
            phone: '',
            email: '',
        })
        const customer = ref([]);
        const form = reactive({
            orderQty: 0,
            unitPrice: 0,
            discount: 0,
            iva: 0,
        });
        const type = ref(false);
        const usage = ref([]);
        const sale = reactive({
            customer_id : 0,
            iva : 0,
            subtotal : 0,
            total : 0,
            discount : 0,
        });
        const detailsSale = ref([]);
        const search = ref('');
        const maxDiscount = ref('');
        const errorForm = ref(false);
        const total = computed(()=>{
            let sum = 0;
            sum = sum + detailsSale.value.length;
            return sum;
        });
        const subtotalSale = computed(() => {
            let sum = 0;
            for (let i = 0; i < detailsSale.value.length; i++) {
                sum = parseFloat(sum) + (parseFloat(detailsSale.value[i].orderQty * detailsSale.value[i].unitPrice) - detailsSale.value[i].discount );
            }
            return sum.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        });
        const calcIva = computed(() => {
            let sum = 0;
            for (let i = 0; i < detailsSale.value.length; i++) {
                sum = parseFloat(sum) + (parseFloat(detailsSale.value[i].orderQty * detailsSale.value[i].unitPrice) - detailsSale.value[i].discount );
            }
            let iva = sum * (parseInt(form.iva) / 100);
            return iva.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        });
        const totalSale = computed(() => {
            let sum = 0;
            for (let i = 0; i < detailsSale.value.length; i++) {
                sum = parseFloat(sum) + (parseFloat(detailsSale.value[i].orderQty * detailsSale.value[i].unitPrice) - detailsSale.value[i].discount );
            }
            let iva = sum * (parseInt(form.iva) / 100);
            sum = sum + iva;
            return sum.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        });
        const totalQty = computed(() => {
            let sum = 0;
            for (let i = 0; i < detailsSale.value.length; i++) {
                sum = parseFloat(sum) + parseFloat(detailsSale.value[i].orderQty);
            }
            return sum;
        });
        const totalDiscount = computed(() => {
            let sum = 0;
            for (let i = 0; i < detailsSale.value.length; i++) {
                sum = parseFloat(sum) + parseFloat(detailsSale.value[i].discount);
            }
            return sum.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        });

        const {saveCustomer} = useCustomer();
        const {searchProduct, products} = useProducts();
        const {allUsages, usages} = useUsages();
        const {errors, saveSale, sale_id} = useSale();
        const {errorToast} = useToast();

        const saveC =  async () => {
            if (formCustomer.name === ''){
                errorsC.value = true
                return true;
            } else {
                await saveCustomer(formCustomer);
                await allCustomers();
                clearCustomer();
                $('#btnCloseCust').click();
                errorsC.value = false;
            }
        }

        const fetchCustomer = async(query) => {
           let res = await axios.get(`/api/select-customer/${query}`);
           return res.data;

        }

        const clearCustomer = () =>{
            formCustomer.name = '';
            formCustomer.last_name = '';
            formCustomer.document = '';
            formCustomer.address = '';
            formCustomer.phone = '';
            errorsC.value = false;
        }

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
                    $("#txtPName").val(products.value.name+" * "+ products.value.presentacion);
                    $("#txtStock").text(products.value.stock);
                    form.unitPrice = products.value.price;
                    maxDiscount.value = products.value.discount;
                    $("#txtQuantity").focus().select();
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Producto no fue encontrado, Verifique!',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    $("#txtPName").val('');
                    $("#txtStock").val('');
                    $("#txtPrice").val('');
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
            }
            else{
                form.product_id = products.value.id;
                form.code = products.value.code;
                form.product = $("#txtPName").val();
                detailsSale.value.push( { ...form } );
                clearProduct();
                $("#txtpCode").focus();
            }
        }

        const addProd = (product) => {
            $("#errorTable").hide();
            $("#errorTable2").hide();
            $("#errorTable3").hide();

            if(product.qtyOrder === 0){
                $("#errorTable").show();
                return;
            }

            if(product.qtyOrder > product.stock){
                $("#errorTable2").show();
                return;
            }

            if(product.discountOrder > product.discount){
                $("#errorTable3").show();
                return;
            }

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
                    'unitPrice' : product.price,
                    'product' : product.name + " * " + product.presentation.name
                };

                detailsSale.value.push( data );
                search.value = '';
                usage.value = [];
                $("#txtSearchProd").focus();
                products.value = [];
            }
        }

        const remove = (index) => {
            Swal.fire({
                title: '¿Estas Seguro?',
                text: "No se podra recuperar los datos",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    detailsSale.value.splice(index, 1);
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
            maxDiscount.value = '';
            $("#txtPName").val('');
            $("#txtStock").text('');
            $("#txtPrice").val('');
        }

        const verify = (id) => {
            var temp = false;
            for (let i = 0; i < detailsSale.value.length; i++) {
                if (detailsSale.value[i].product_id == id) {
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
            }else if (form.orderQty > products.value.stock){
                errorToast();
                $("#errorUpper").show();
                error = true;
            }else if (form.discount > products.value.discount){
               Swal.fire('Verifique','El descuento no puede superar el monto comprado', 'error');
                error = true;
            }

            errorForm.value = error;

            return errorForm.value;
        }

        const hideError = () => {
            $("#errorCode").hide();
            $("#errorQty").hide();
            $("#errorUpper").hide();
        }

        const save = async () => {
            let user = JSON.parse(localStorage.getItem('user'));
            sale.customer_id = customer.value;
            sale.iva = calcIva.value.replace(',','');
            sale.subtotal = subtotalSale.value.replace(',','');
            sale.total = totalSale.value.replace(',','');
            sale.discount = totalDiscount.value.replace(',','');
            sale.details = detailsSale.value;
            await saveSale(sale);
            await sale_id;
            await errors;
            if (errors.value.length === 0){
                detailsSale.value = [];
                customer.value = [];
                clearProduct();
                axios({ url: `/api/invoice/${sale_id.value.data}/stream`, method: 'GET', responseType: 'blob'})
                    .then(response=>{
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('href',  `/api/invoice/${sale_id.value.data}/stream`);
                        link.setAttribute('target', '_blank');
                        link.click();
                    });
            }
        }

        allUsages();

        watch(customer, async () => {
            let res = await axios.get(`/api/findcustomer/${customer.value}`);
            detailsCustomer.phone = res.data.phone,
            detailsCustomer.address = res.data.address,
            detailsCustomer.email = res.data.email,
            $('#txtpCode').focus();
        });

        watch(usage, async ()=>{
           await searchProduct('usage', usage.value.id);
        });

        return {formCustomer, errorsC, saveC, clearCustomer, form, type, usages, usage, products, detailsSale, customer, detailsCustomer, search, clearProduct, modalProduct, searchProd, addDetails, addProd, remove, subtotalSale, totalQty, totalDiscount, total, errors, save, fetchCustomer, maxDiscount, calcIva, totalSale }

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
.b-transparent{
    background: transparent;
}
</style>
