<template>
    <breadcrumb-component folder="Almacén" subfolder="Usos"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Usos del Producto
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <search-component @search="findUsage"/>
                <table-component :data="usages" @load="loadUsage"/>
                <pagination-component name="usage" :pagination="pagination" />
            </div>
        </div>
    </div>
    <delete-component title="Uso del Producto" :data="usage" @delete="destroyUsage" />

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Uso del Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Descripción del uso del producto" v-model.trim="form.description">
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
                    <h5 class="modal-title">Actualizar Uso del Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Descripción del uso del producto" v-model="usage.description">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCloseUpdate" data-dismiss="modal" @click="clear">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="updatingUsage">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</template>

<script>
import TableComponent from "../components/Usage/TableComponent";
import SearchComponent from "../components/SearchComponent";
import {useUsages} from "../composables/useUsages";
import {useToast} from "../composables/useToast";
import {watch, onMounted, reactive, ref} from "vue";
export default {
    name: "Usage",
    components:{
        TableComponent,
        SearchComponent
    },
    setup(){
        const form = reactive({
            description: ''
        })
        const usage = ref([]);
        const { usages, pagination, route, getAll, saveUsage, errors, deleteUsage, updateUsage } = useUsages();
        const {successToast} = useToast();

        const save = async () => {
            await saveUsage(form);
            await errors;
            if (errors.value.length === 0){
                await clear();
                await getAll();
            }
        }

        const findUsage = async(data) => {
            await getAll(data);
        }

        const loadUsage = async (data) => {
            usage.value = { ...data };
        }

        const updatingUsage = async () => {
            await updateUsage(usage.value);
            getAll();
        }

        const destroyUsage = async (id) => {
            await deleteUsage(id);
            await getAll();
            successToast('Eliminado')
        }

        const clear = () => {
            form.description = ''
        }

        onMounted(getAll);

        watch(() => route.query.page , () => {
            getAll()
        })

        return { form, usages, pagination, errors, save, findUsage, loadUsage, usage, destroyUsage, updatingUsage, clear };
    }
}
</script>

<style scoped>

</style>
