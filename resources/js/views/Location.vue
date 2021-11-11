<template>
    <breadcrumb-component folder="Almacén" subfolder="Ubicación"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Ubicación
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <search-component @search="findLocation"/>
                <table-component :data="locations"  @load="loadLocation" />
                <pagination-component :pagination="pagination"/>
            </div>
        </div>
    </div>
    <delete-component title="presentación" :data="location" @delete="destroyLocation"  />

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Ubicación</h5>
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

    <!--Inicio del modal actualizar-->
    <div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-warning modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Ubicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre de ubicación" v-model="location.name">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors.replace('name', 'nombre') }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCloseUpdate" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="updatingLocation">Actualizar</button>
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
import SearchComponent from "../components/SearchComponent";
import PaginationComponent from "../components/PaginationComponent";
import DeleteComponent from "../components/DeleteComponent";
import { useLocations } from '../composables/useLocations';
import {useToast} from "../composables/useToast";
import {reactive, watch, onMounted, ref } from "vue";
export default {
    name: "Location",
    components: {
        BreadcrumbComponent,
        TableComponent,
        SearchComponent,
        PaginationComponent,
        DeleteComponent
    },
        setup(){
        const search = ref('');
        const location = ref([]);
        const form = reactive({
            id : 0,
            name : '',
        })

        const {locations, pagination, route, getAll, saveLocation, deleteLocation, updateLocation, errors } = useLocations();
        const {successToast} = useToast();

        const save = async() => {
            await saveLocation(form);
            await clear();
            await getAll();
        };

        const destroyLocation = async(id) =>{
            await deleteLocation(id);
            await getAll();
            successToast('Eliminado')
        };

        const updatingLocation = async () => {
            await updateLocation(location.value);
            await getAll();
        };

        const loadLocation = async (data) => {
            location.value = { ...data };
        }

        const clear = () => {
            form.name = '';
        }

        const findLocation = async(data) => {
            await getAll(data);
        }

        onMounted(getAll);

        watch(() => route.query.page , () => {
            getAll()
        })
        return { locations, pagination, route, getAll, save, form, destroyLocation, updatingLocation,  errors, clear, loadLocation, findLocation, location };
    }
}
</script>

<style scoped>

</style>
