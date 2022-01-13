<template>
    <breadcrumb-component folder="Almacén" subfolder="Devolución   /   Crear"/>
    <div class="row col-md-12 justify-content-center">
        <h5>Registrar Devolución</h5>
    </div>
    <div class="container pb-1 pt-2 shadow b-white">
        <div class="row form-group">
            <div class="col-md-8">
                <label class="ml-3 form-control-label" for="name">Proveedor</label>
                <vue-select v-model="supplier" :options="suppliers" label-by="name" placeholder="Seleccione el proveedor" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-8">
                <label class="ml-3 form-control-label" for="name">Compras</label>
                <select name="" id="" class="form-control">
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>
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
                        <th class="text-center">Devolver</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td> product.code </td>
                        <td width="40%"> product.name *  product.presentation.name </td>
                        <td width="10%" height="42px" class="p-0 text-center">22/12/2021</td>
                        <td width="10%" height="42px" class="p-0 text-center">20</td>
                        <td width="10%" height="42px" class="p-0"><input class="border-0 inputTable" type="number"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group d-flex justify-content-end">
            <button class="btn btn-success mr-2">Guardar</button>
            <router-link class="btn btn-danger" :to="{ name : 'reimbursement' }">Cancelar</router-link>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
import {computed, reactive, ref, watch} from "vue";
import VueSelect from 'vue-next-select';
import 'vue-next-select/dist/index.min.css';
import {useSuppliers} from "../../composables/useSuppliers";
export default {
    name: "CreateComponent",
    components:{
        VueSelect
    },
    setup(){
        const supplier = ref([]);
        const {allSuppliers, suppliers} = useSuppliers();

        allSuppliers();

        watch(supplier, () => {
            console.log('buscando compras relacionadas')
        });
        return{ supplier, suppliers }
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
