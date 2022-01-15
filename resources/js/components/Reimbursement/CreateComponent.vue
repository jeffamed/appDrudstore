<template>
    <breadcrumb-component folder="Almacén" subfolder="Devolución   /   Crear"/>
    <div class="row col-md-12 justify-content-center">
        <h5>Registrar Devolución</h5>
    </div>
    <div class="container pb-1 pt-2 shadow b-white">
        <form @submit.prevent="save">
            <div class="row form-group">
                <div class="col-md-8">
                    <label class="ml-3 form-control-label" for="name">Proveedor</label>
                    <vue-select v-model="supplier" :options="suppliers" value-by="id" label-by="name" placeholder="Seleccione el proveedor" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-8">
                    <label class="ml-3 form-control-label" for="name">Compras</label>
                    <Multiselect
                        v-model="order"
                        placeholder="Seleccione la compra"
                        :filter-results="false"
                        :min-chars="1"
                        valueProp="id"
                        noOptionsText="La lista esta vacía"
                        :resolve-on-load="false"
                        :delay="0"
                        :searchable="true"
                        :options="orders"
                        trackBy="created_at"
                        label="created_at"
                    />
                </div>
                <div class="col-md-4">
                    <label class="ml-3 form-control-label" for="name">Total de la compra $:</label>
                    <input type="number" class="form-control" disabled :value="totalOrder">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-12">
                    <label class="ml-3 form-control-label" for="name">Observación</label>
                    <textarea cols="3" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <label class="ml-3 form-control-label" for="name">Productos Comprados</label>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Producto</th>
                            <th class="text-center">F.Venc</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">P. Compra</th>
                            <th class="text-center">Devolver</th>
                            <th class="text-center">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-if="products.length" v-for="product in products" :key="product.id">
                                <td>{{ product.code }}</td>
                                <td width="40%">{{ product.name }} * {{ product.presentation.name }}</td>
                                <td width="10%" height="42px" class="p-0 text-center">{{ moment(product.expire).format('DD/MM/Y') }}</td>
                                <td width="10%" height="42px" class="p-0 text-center">{{ product.order }}</td>
                                <td width="10%" height="42px" class="p-0 text-center">{{ product.unitPrice }}</td>
                                <td width="10%" height="42px" class="p-0"><input class="border-0 inputTable" type="number" v-model="product.reimbursement" min="0" :max="product.order"></td>
                                <td width="10%" height="42px" class="p-0 text-center">{{ parseFloat((product.unitPrice * product.reimbursement)).toFixed(2) }}</td>
                            </tr>
                            <tr v-else>
                                <td colspan="7" class="text-center">Seleccione una compra</td>
                            </tr>
                        </tbody>
                        <tfoot v-show="products.length">
                            <tr>
                                <td colspan="6">Total de la devolución:</td>
                                <td class="font-weight-bold text-center">{{ totalReimbursement }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div  v-show="errors.length">
                <ul v-for="(error, index) in (errors.slice(0, -2)).split('/')" :key="index" class="m-0">
                    <li class="help-block text-danger" >{{error}}</li>
                </ul>
            </div>

            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-success mr-2">Guardar</button>
                <router-link class="btn btn-danger" :to="{ name : 'reimbursement' }">Cancelar</router-link>
            </div>
        </form>
    </div>
</template>

<script>
import Swal from "sweetalert2";
import {computed, reactive, ref, watch} from "vue";
import VueSelect from 'vue-next-select';
import Multiselect from "@vueform/multiselect";
import 'vue-next-select/dist/index.min.css';
import {useSuppliers} from "../../composables/useSuppliers";
import {useOrder} from "../../composables/useOrder";
import {useProducts} from "../../composables/useProducts";
import moment from "moment";
import {useReimbursement} from "../../composables/useReimbursement";
export default {
    name: "CreateComponent",
    components:{
        VueSelect,
        Multiselect
    },
    created: function () {
        this.moment = moment;
    },
    setup(){
        const supplier = ref([]);
        const order = ref('');
        const totalOrder = ref(0);
        const {getOrderSupplier, orders} = useOrder()
        const {allSuppliers, suppliers} = useSuppliers();
        const {searchProduct, products} = useProducts();
        const {saveReimbursement, errors} = useReimbursement();

        const totalReimbursement = computed(() => {
            let sum = 0;
            for (let i = 0; i < products.value.length; i++) {
                sum = parseFloat(sum) + (parseFloat(products.value[i].reimbursement * products.value[i].unitPrice) );
            }
            return parseFloat(sum).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        });

        allSuppliers();

        const save = async () => {
            let form = {
                'supplier_id' : supplier.value,
                'order_id' : order.value,
                'total' : totalReimbursement.value.replace(',', ''),
                'products' : products.value,
            };
            await saveReimbursement(form);
            await errors;
        }

        watch(supplier, async () => {
            orders.value = {};
            await getOrderSupplier(supplier.value)
            await orders;
        });

        watch(order, async () => {
            products.value = {};
            let find = orders.value.find(  or => or.id === order.value);
            totalOrder.value = parseFloat(find.total).toFixed(2);
            await searchProduct('order', order.value)
            await products;
        });

        return{ supplier, suppliers, orders, order, products, totalReimbursement, totalOrder, save, errors }
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
