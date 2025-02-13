<template>
    <breadcrumb-component folder="Almacén" subfolder="Laboratorios"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Laboratorios
                <button v-show="btnCreate" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
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

    <delete-component title="Laboratorio" body="el laboratorio" :data="laboratory" @delete="destroyLaboratory" />

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Laboratorio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="save">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Nombre del Laboratorio" v-model="form.name">
                                <span class="help-block text-danger" v-show="errors.name.length">(*) {{ errors.name }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                            <div class="col-md-9">
                                <input type="text" name="direccion" class="form-control" placeholder="Dirección del Laboratorio" v-model="form.address">
                                <span class="help-block text-danger" v-show="errors.address.length">(*) {{ errors.address }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clear">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
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
                    <h5 class="modal-title">Actualizar Laboratorio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="updatingLaboratory">
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
                                <input type="text" name="direccion" class="form-control" placeholder="Dirección del Laboratorio" v-model="laboratory.address">
                                <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnCloseUpdate" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
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
import TableComponent from "../components/Laboratory/TableComponent";
import SearchComponent from "../components/Laboratory/SearchComponent";
import {computed, onMounted, reactive, ref, watch} from "vue";
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
        const {laboratories,errors, route, pagination, getLaboratories, saveLaboratory, updateLaboratory, deleteLaboratory} = useLaboratories();
        const {successToast} =useToast();
        const permissions = localStorage.getItem('permissions');
        const btnCreate = computed(() => {return permissions.includes('laboratory.create')})

        const save = async () => {
            await saveLaboratory(form);
            await errors;
            await clear();
            await getLaboratories();
        }

        const updatingLaboratory = async () => {
            await updateLaboratory(laboratory.value);
            await getLaboratories();
        }

        const destroyLaboratory = async (id) => {
            await deleteLaboratory(id);
            await getLaboratories();
            await successToast('Eliminado');
        }

        const findLaboratory = async(condition, search) => {
            await getLaboratories(condition, search);
        }

        const loadLaboratory = async (data) => {
            laboratory.value = { ...data };
        }

        const clear = () => {
            form.name = '';
            form.address = '';
        }

        watch( () => route.query.page, ()=>{
            getLaboratories();
        });

        onMounted(getLaboratories);

        return {form, laboratories, laboratory, pagination, errors, save, clear, loadLaboratory,  updatingLaboratory, destroyLaboratory, findLaboratory, search, btnCreate}
    }
}
</script>

<style scoped>

</style>
