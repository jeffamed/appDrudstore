<template>
    <breadcrumb-component folder="Almacén" subfolder="Productos   /   Crear"/>
    <div class="container pb-1 pt-2 shadow" style="background: #ffffff">
            <div class="row col-md-12 justify-content-center">
                <h5>Registrar Producto</h5>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <label class="form-control-label" for="code">Código</label>
                    <input type="text" name="code" class="form-control" placeholder="00000X" v-model="form.code">
                </div>
                <div class="col-md-8">
                    <label class="ml-3 form-control-label" for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Nombre del Producto" v-model="form.name">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <label class="form-control-label" for="price">Precio Venta $</label>
                    <input type="number" name="price" step=".01" min="0" class="form-control" placeholder="0.0" v-model="form.price">
                </div>
                <div class="col-md-4">
                    <label class="form-control-label" for="cost">Precio Compra $</label>
                    <input type="number" name="cost" step=".01" min="0" class="form-control" placeholder="0.0" v-model="form.cost">
                </div>
                <div class="col-md-4">
                    <label class="form-control-label" for="discount">Descuento</label>
                    <input type="number" name="discount" step=".01" min="0" class="form-control" placeholder="0.0" v-model="form.discount">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <label class="form-control-label" for="supplier">Proveedor</label>
                    <vue-select v-model="form.supplier_id" :options="suppliers" label-by="name" value-by="id" placeholder="Seleccione el proveedor" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
                </div>
                <div class="col-md-4">
                    <label class="form-control-label" for="laboratory">Laboratorio</label>
                    <vue-select v-model="form.laboratory_id" :options="laboratories" label-by="name" value-by="id" placeholder="Seleccione el Laboratorio" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
                </div>
                <div class="col-md-4">
                    <label class="form-control-label" for="presentation">Presentación</label>
                    <vue-select v-model="form.presentation_id" :options="presentations" label-by="name" value-by="id" placeholder="Seleccione la Presentación" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <label class="form-control-label" for="laboratory">Ubicación</label>
                    <vue-select v-model="form.location_id" :options="locations" label-by="name" value-by="id" placeholder="Seleccione la Ubicacion" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
                </div>
                <div class="col-md-4">
                    <label class="form-control-label" for="type">Tipo</label>
                    <vue-select v-model="form.type_id" :options="types" label-by="name" value-by="id" placeholder="Seleccione la Tipo" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
                </div>
                <div class="col-md-4">
                    <label class="form-control-label" for="unit">Unidades en Caja</label>
                    <input type="number" name="cost"  min="0" class="form-control" placeholder="00" v-model="form.unit_box">
                </div>
            </div>
            <div class="row form-group">
                <hr>
                <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Seleccione los usos
                </a>
                <hr>
                <div class="collapse col-md-12" id="collapseExample" style="max-height: 250px; overflow: auto">
                    <table class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Seleccione</th>
                            <th>Usos</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in usages" :key="item.id" v-if="usages.length">
                            <td>
                                <input type="checkbox" name="cbUsos" id="cbUsos" v-model="form.usage_id" :value="item.id">
                            </td>
                            <td v-text="item.description"></td>
                        </tr>
                        <tr v-else>
                            <td colspan="2" class="text-center">No hay datos Registrados</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>

            <div class="row form-group">
                <div class="col-md-12">
                    <router-link :to="{ name: 'product' }" class="btn btn-danger float-right"> Cancelar</router-link>
                    <button class="btn btn-success mr-2 float-right" @click="save">Guardar</button>
                </div>
            </div>
        </div>
</template>

<script>
import {onMounted, reactive} from "vue";
import VueSelect from 'vue-next-select';
import 'vue-next-select/dist/index.min.css';
import {useSuppliers} from "../../composables/useSuppliers";
import {useLaboratories} from "../../composables/useLaboratories";
import {usePresentations} from "../../composables/usePresentations";
import {useLocations} from "../../composables/useLocations";
import {useTypes} from "../../composables/useTypes";
import {useUsages} from "../../composables/useUsages";
import {useProducts} from "../../composables/useProducts";
export default {
    name: "CreateComponent",
    components:{
      VueSelect
    },
    setup(){
        const form = reactive({
            code: '',
            name: '',
            price: 0,
            cost: 0,
            discount: 0,
            stock: 0,
            box_stock: 0,
            unit_box: 0,
            expire_at: '',
            supplier_id: 0,
            laboratory_id: 0,
            type_id: 0,
            location_id: 0,
            presentation_id: 0,
            costPrev: 0,
            usage_id: [],
        })
        const {allSuppliers, suppliers} = useSuppliers();
        const {allLaboratories, laboratories} = useLaboratories();
        const {allPresentations, presentations} = usePresentations();
        const {allLocations, locations} = useLocations();
        const {allTypes, types} = useTypes();
        const {allUsages, usages} = useUsages();
        const {saveProduct, errors} = useProducts();

        const save = async () => {
            await errors;
            await saveProduct(form);
        }

        const clear = () => {
            form.code = '';
            form.name = '';
            form.price = 0;
            form.cost = 0;
            form.discount = 0;
            form.stock = 0;
            form.box_stock = 0;
            form.unit_box = 0;
            form.expire_at = '';
            form.supplier_id = 0;
            form.laboratory_id = 0;
            form.type_id = 0;
            form.location_id = 0;
            form.presentation_id = 0;
            form.usage_id = [];
        }

        allSuppliers();
        allLaboratories();
        allPresentations();
        allLocations();
        allTypes();
        allUsages();

        return {form, suppliers, laboratories, presentations, locations, types, usages, save, errors};
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
</style>
