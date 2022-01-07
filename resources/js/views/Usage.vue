<template>
    <breadcrumb-component folder="Almacén" subfolder="Usos"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Usos del Producto
                <button v-show="btnCreate" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
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
    <delete-component title="Uso del Producto" body="el uso" :data="usage" @delete="destroyUsage" />

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
import {watch, onMounted, reactive, ref, computed} from "vue";
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
        const { usages, pagination, route, getUsages, saveUsage, errors, deleteUsage, updateUsage } = useUsages();
        const {successToast} = useToast();
        const permissions = localStorage.getItem('permissions');
        const btnCreate = computed(() => {return permissions.includes('usage.create')})

        const save = async () => {
            await saveUsage(form);
            await errors;
            if (errors.value.length === 0){
                await clear();
                await getUsages();
            }
        }

        const findUsage = async(data) => {
            await getUsages(data);
        }

        const loadUsage = async (data) => {
            usage.value = { ...data };
        }

        const updatingUsage = async () => {
            await updateUsage(usage.value);
            getUsages();
        }

        const destroyUsage = async (id) => {
            await deleteUsage(id);
            await getUsages();
            successToast('Eliminado')
        }

        const clear = () => {
            form.description = ''
        }

        onMounted(getUsages);

        watch(() => route.query.page , () => {
            getUsages()
        })

        return { form, usages, pagination, errors, save, findUsage, loadUsage, usage, destroyUsage, updatingUsage, clear, btnCreate };
    }
}
</script>

<style scoped>

</style>
