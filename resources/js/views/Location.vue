<template>
    <breadcrumb-component folder="Almacén" subfolder="Ubicación"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Ubicación
                <button v-show="btnCreate" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <search-component @search="findLocation"/>
                <table-component :data="locations" permission="location" @load="loadLocation" />
                <pagination-component name="location" :pagination="pagination"/>
            </div>
        </div>
    </div>
    <delete-component title="Ubicación" :data="location" @delete="destroyLocation"  />

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
                <form @submit.prevent="save">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre de ubicación" v-model="form.name">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors.replace('name', 'nombre') }}</span>
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
                    <h5 class="modal-title">Actualizar Ubicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="updatingLocation">
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
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/TableComponent";
import SearchComponent from "../components/SearchComponent";
import PaginationComponent from "../components/PaginationComponent";
import DeleteComponent from "../components/DeleteComponent";
import { useLocations } from '../composables/useLocations';
import {useToast} from "../composables/useToast";
import {reactive, watch, onMounted, ref, computed} from "vue";
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

        const {locations, pagination, route, getLocations, saveLocation, deleteLocation, updateLocation, errors } = useLocations();
        const {successToast} = useToast();
            const permissions = localStorage.getItem('permissions');
            const btnCreate = computed(() => {return permissions.includes('location.create')})

            const save = async() => {
            await saveLocation(form);
            await errors;
            if (errors.value.length === 0){
                await clear();
                await getLocations();
            }
        };

        const destroyLocation = async(id) =>{
            await deleteLocation(id);
            await getLocations();
            successToast('Eliminado')
        };

        const updatingLocation = async () => {
            await updateLocation(location.value);
            await getLocations();
        };

        const loadLocation = async (data) => {
            location.value = { ...data };
        }

        const clear = () => {
            form.name = '';
        }

        const findLocation = async(data) => {
            await getLocations(data);
        }

        onMounted(getLocations);

        watch(() => route.query.page , () => {
            getLocations()
        })
        return { locations, pagination, route, getLocations, save, form, destroyLocation, updatingLocation,  errors, clear, loadLocation, findLocation, location, btnCreate };
    }
}
</script>

<style scoped>

</style>
