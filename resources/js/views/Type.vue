<template>
    <breadcrumb-component folder="Almacén" subfolder="Tipos"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Tipos de Productos
                <button v-show="btnCreate" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <search-component @search="findType"/>
                <table-component :data="types" permission="type" @load="loadType" />
                <pagination-component name="type" :pagination="pagination"/>
            </div>
        </div>
    </div>

    <delete-component title="Tipo de Producto" body="el tipo" :data="type" @delete="destroyType" />

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Tipo de Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del tipo de producto" v-model.trim="form.name">
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
                    <h5 class="modal-title">Actualizar Tipo de Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del tipo de producto" v-model="type.name">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCloseUpdate" data-dismiss="modal" @click="clear">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="updatingType">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</template>

<script>
import SearchComponent from "../components/SearchComponent";
import TableComponent from "../components/TableComponent";
import {computed, onMounted, reactive, ref, watch} from "vue";
import {useTypes} from "../composables/useTypes";
import {useToast} from "../composables/useToast";
export default {
    name: "Type",
    components: {
        TableComponent,
        SearchComponent,
    },
    setup(){
        const type = ref([]);
        const form = reactive({
            id : 0,
            name : '',
        })

        const { types, pagination, route, errors, getTypes, saveType, updateType, deleteType } = useTypes();
        const {successToast} = useToast();
        const permissions = localStorage.getItem('permissions');
        const btnCreate = computed(() => {return permissions.includes('type.create')})

        const save = async() => {
            await saveType(form);
            await errors;
            if (errors.value.length === 0){
                await clear();
                await getTypes();
            }
        };

        const updatingType = async () => {
            await updateType(type.value);
            getTypes();
        };

        const destroyType = async (id) => {
            await deleteType(id);
            getTypes();
            successToast('Eliminado');
        }

        const loadType = async (data) => {
            type.value = { ...data };
        }

        const findType = async(data) => {
            await getTypes(data);
        }

        const clear = () => {
            form.name = '';
        }

        watch(() => route.query.page , () => {
            getTypes()
        })

        onMounted(getTypes);

        return {form, types, type, pagination, errors, save, loadType, updatingType, destroyType, findType, clear, btnCreate};
    }
}
</script>

<style scoped>

</style>
