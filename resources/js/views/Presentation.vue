<template>
    <breadcrumb-component folder="Almacén" subfolder="Presentación"/>
    <table-component title="Presentación" :data="presentations" :pagination="pagination" @delete="destroyPresentation" @update="updatingPresentation" @search="findPresentation"/>
    <!--Inicio del modal agregar/actualizar-->
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
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre de presentación" v-model="form.name">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors.replace('name', 'nombre') }}</span>
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

</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
import { usePresentations } from '../composables/usePresentations';
import {reactive, watch, onMounted, ref, provide} from "vue";
import Swal from 'sweetalert2';
export default {
    components: {
        BreadcrumbComponent,
        TableComponent
    },
    setup(){
        const search = ref('');
        const form = reactive({
            id : 0,
            name : '',
        })

        const {presentations, pagination, route, Toast, getAll, savePresentation, deletePresentation, updatePresentation, errors} = usePresentations();

        provide('errors', errors);

        const save = async() => {
            await savePresentation(form);
            await clear();
            await getAll();
        };

        const destroyPresentation = async(id) =>{
            await deletePresentation(id);
            await getAll();
            Toast.fire({
                icon: 'success',
                title: 'Eliminado Exitosamente'
            })
        };

        const updatingPresentation = async (data) => {
            await updatePresentation(data);

            await getAll();
        };

        const findPresentation = async(data) => {
            await getAll(data);
        }

        const clear = () => {
            form.name = '';
        }

        onMounted(getAll);

        watch(() => route.query.page , () => {
            getAll()
        })
        return { presentations, pagination, route, getAll, save, form, destroyPresentation, updatingPresentation, findPresentation, errors, clear };
    }
}
</script>

<style scoped>

</style>
