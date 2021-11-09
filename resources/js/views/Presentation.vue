<template>
    <breadcrumb-component folder="Almacén" subfolder="Presentación"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Presentación
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <search-component @search="findPresentation"/>
                <table-component :data="presentations"  @load="loadPresentation" />
                <pagination-component name="presentation" :pagination="pagination"/>
            </div>
        </div>
    </div>
    <delete-component title="presentación" :data="presentation" @delete="destroyPresentation"  />

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Presentación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre de presentación" v-model.trim="form.name">
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
                    <h5 class="modal-title">Actualizar Presentación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre de presentación" v-model="presentation.name">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCloseUpdate" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="updatingPresentation">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</template>

<script>
import TableComponent from "../components/TableComponent";
import SearchComponent from "../components/SearchComponent";
import { usePresentations } from '../composables/usePresentations';
import {useToast} from "../composables/useToast";
import {reactive, watch, onMounted, ref } from "vue";
export default {
    components: {
        TableComponent,
        SearchComponent,
    },
    setup(){
        const search = ref('');
        const presentation = ref([]);
        const form = reactive({
            id : 0,
            name : '',
        })

        const {presentations, pagination, route, getAll, savePresentation, deletePresentation, updatePresentation, errors } = usePresentations();
        const {successToast} = useToast();

        const save = async() => {
            await savePresentation(form);
            await clear();
            await getAll();
        };

        const destroyPresentation = async(id) =>{
            await deletePresentation(id);
            await getAll();
            successToast('Eliminado')
        };

        const updatingPresentation = async () => {
            await updatePresentation(presentation.value);
            await getAll();
        };

        const loadPresentation = async (data) => {
            presentation.value = data;
        }

        const clear = () => {
            form.name = '';
        }

        const findPresentation = async(data) => {
            await getAll(data);
        }

        onMounted(getAll);

        watch(() => route.query.page , () => {
            getAll()
        })
        return { presentations, pagination, save, form, destroyPresentation, updatingPresentation, errors, clear, loadPresentation, findPresentation, presentation };
    }
}
</script>

<style scoped>

</style>
