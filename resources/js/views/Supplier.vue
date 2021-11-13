<template>
    <breadcrumb-component folder="Compras" subfolder="Proveedor"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Proveedores
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <search-component @search="findSupplier" />
                <table-component :data="suppliers" @load="loadSupplier" />
                <pagination-component name="supplier" :pagination="pagination"/>
            </div>
        </div>
    </div>

    <delete-component title="Proveedor" :data="supplier" @delete="destroySupplier" />

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Proveedores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">RUC</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Ruc del Proveedor" v-model="form.ruc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Nombre del Proveedor" v-model="form.name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion del Proveedor" v-model="form.address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Teléfono</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Teléfono del Proveedor" v-model="form.phone">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clear">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="save">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-warning modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Proveedores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">RUC</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Ruc del Proveedor" v-model="supplier.ruc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Nombre del Proveedor" v-model="supplier.name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion del Proveedor" v-model="supplier.address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Teléfono</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Teléfono del Proveedor" v-model="supplier.phone">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clear">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="updatingSupplier">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</template>

<script>
import TableComponent from "../components/Supplier/TableComponent";
import SearchComponent from "../components/Supplier/SearchComponent";
import {onMounted, reactive, ref, watch} from "vue";
import {useSuppliers} from "../composables/useSuppliers";
export default {
    name: "Supplier",
    components: {
        TableComponent,
        SearchComponent
    },
    setup(){
        const form = reactive({
            ruc: '',
            name: '',
            address: '',
            phone: ''
        })
        const supplier = ref([]);
        const { suppliers, pagination, errors, route, getAll, saveSupplier, updateSupplier, deleteSupplier } = useSuppliers();

        const save = async () => {
            await saveSupplier(form);
            await getAll();
            await clear()
        }

        const updatingSupplier = async () => {
            await updateSupplier(supplier.value);
            await getAll();
        }

        const destroySupplier = async (id) => {
            await deleteSupplier(id);
            await getAll();
            await successToast('Eliminado');
        }

        const findSupplier = async(condition, search) => {
            await getAll(condition, search);
        }

        const loadSupplier = async (data) => {
            supplier.value = { ...data };
        }

        const clear = () => {
          form.ruc = '';
          form.name = '';
          form.address = '';
          form.phone = '';
        }

        watch( () => route.query.page, ()=>{
            getAll();
        });

        onMounted(getAll);

        return {form, suppliers, supplier, pagination, errors, clear, save, findSupplier, loadSupplier, updatingSupplier, destroySupplier};
    }
}
</script>

<style scoped>

</style>
