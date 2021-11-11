<template>
    <breadcrumb-component folder="Almacén" subfolder="Laboratorios"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Laboratorios
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <search-component @search="findLaboratory" :options="search"/>
                <table-component :data="laboratories" @load="loadLaboratory" />
                <pagination-component name="laboratory" :pagination="pagination"/>
            </div>
        </div>
    </div>

    <delete-component title="Laboratorio" :data="laboratory" @delete="destroyLaboratory" />

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Laboratorios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Nombre del Laboratorio" v-model="form.name">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion del Laboratorio" v-model="form.address">
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

    <!--Inicio del modal actualizar-->
    <div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-warning modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Laboratorios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Nombre del Laboratorio" v-model="laboratory.name">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion del Laboratorio" v-model="laboratory.address">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCloseUpdate" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="updatingLaboratory">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</template>

<script>
import TableComponent from "../components/Laboratory/TableComponent";
import SearchComponent from "../components/Laboratory/SearchComponent";
import {onMounted, reactive, ref, watch} from "vue";
import {useToast} from "../composables/useToast";
import {useLaboratories} from "../composables/useLaboratories";
export default {
    name: "Laboratory",
    components: {
        TableComponent,
        SearchComponent,
    },
    setup(){
        const form = reactive({
            name: '',
            address: ''
        })
        const search = ref({
            name : 'Nombre',
            address : 'Dirección'
        });
        const laboratory = ref([]);
        const {laboratories,errors, route, pagination, getAll, saveLaboratory, updateLaboratory, deleteLaboratory} = useLaboratories();
        const {successToast} =useToast();

        const save = async () => {
            await saveLaboratory(form);
                await clear();
            await getAll();
        }

        const updatingLaboratory = async () => {
            await updateLaboratory(laboratory.value);
            await getAll();
        }

        const destroyLaboratory = async (id) => {
            await deleteLaboratory(id);
            await getAll();
            await successToast('Eliminado');
        }

        const findLaboratory = async(condition, search) => {
            await getAll(condition, search);
        }

        const loadLaboratory = async (data) => {
            laboratory.value = { ...data };
        }

        const clear = () => {
            form.name = '';
            form.address = '';
        }

        watch( () => route.query.page, ()=>{
            getAll();
        });

        onMounted(getAll);

        return {form, laboratories, laboratory, pagination, errors, save, clear, loadLaboratory,  updatingLaboratory, destroyLaboratory, findLaboratory, search}
    }
}
</script>

<style scoped>

</style>
