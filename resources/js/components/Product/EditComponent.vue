<template>
    <breadcrumb-component folder="Almacén" subfolder="Productos   /   Editar"/>
    <div class="container pb-3 pt-2" style="background: #ffffff">
        <div class="row col-md-12 justify-content-center">
            <h5>Editar Producto</h5>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="form-control-label" for="code">Código</label>
                <input type="text" name="code" class="form-control" placeholder="00000X" v-model="product.code">
            </div>
            <div class="col-md-8">
                <label class="ml-3 form-control-label" for="name">Nombre</label>
                <input type="text" name="name" class="form-control" placeholder="Nombre del Producto" v-model="product.name">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="form-control-label" for="price">Precio Venta $</label>
                <input type="number" name="price" step=".01" min="0" class="form-control" placeholder="0.0" v-model="product.price">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="cost">Precio Compra $</label>
                <input type="number" name="cost" step=".01" min="0" class="form-control" placeholder="0.0" v-model="product.cost">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="discount">Descuento</label>
                <input type="number" name="discount" step=".01" min="0" class="form-control" placeholder="0.0" v-model="product.discount">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="form-control-label" for="supplier">Proveedor</label>
                <vue-select v-model="product.supplier_id" :options="suppliers" label-by="name" :placeholder="product.proveedor" value-by="id" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="laboratory">Laboratorio</label>
                <vue-select v-model="product.laboratory_id" :options="laboratories" label-by="name" :placeholder="product.laboratorio" value-by="id" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="presentation">Presentación</label>
                <vue-select v-model="product.presentation_id" :options="presentations" label-by="name" :placeholder="product.presentacion" value-by="id" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="form-control-label" for="laboratory">Ubicación</label>
                <vue-select v-model="product.location_id" :options="locations" label-by="name" :placeholder="product.ubicacion" value-by="id" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="type">Tipo</label>
                <vue-select v-model="product.type_id" :options="types" label-by="name" :placeholder="product.tipo" value-by="id" clear-on-select close-on-select searchable class="form-control" style="width: 100%"></vue-select>
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="expire_at">Fecha de Expiración</label>
                <input type="date" name="expire_at" class="form-control" v-model="product.expire_at">
            </div>
        </div>
        <div class="row form-group">
            <hr>
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Seleccione los usos
            </a>
            <hr>
            <div class="collapse show col-md-12" id="collapseExample" style="max-height: 250px; overflow: auto">
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
                            <input type="checkbox" name="cbUsos" id="cbUsos" v-model="product.usage_id" :value="item.id" >
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
import VueSelect from 'vue-next-select';
import 'vue-next-select/dist/index.min.css';
import {useProducts} from "../../composables/useProducts";
import {onMounted} from "vue";
import {useSuppliers} from "../../composables/useSuppliers";
import {useLaboratories} from "../../composables/useLaboratories";
import {usePresentations} from "../../composables/usePresentations";
import {useLocations} from "../../composables/useLocations";
import {useTypes} from "../../composables/useTypes";
import {useUsages} from "../../composables/useUsages";

export default {
    name: "EditComponent",
    components:{
      VueSelect,
    },
    props: {
        id: {
            required: true,
            type: String
        }
    },
    setup(props){
        const {getProduct, updateProduct, product, errors} = useProducts();
        const {getSuppliers, suppliers} = useSuppliers();
        const {getLaboratories, laboratories} = useLaboratories();
        const {getPresentations, presentations} = usePresentations();
        const {getLocations, locations} = useLocations();
        const {getTypes, types} = useTypes();
        const {allUsages, usages} = useUsages();

        const save = async() => {
            await updateProduct(props.id);
        }

        onMounted(getProduct(props.id));
        getSuppliers();
        getLaboratories();
        getPresentations();
        getLocations();
        getTypes();
        allUsages();

        return {suppliers, laboratories, presentations, locations, types, usages, product, errors, save}
    }
}
</script>

<style scoped>

</style>
