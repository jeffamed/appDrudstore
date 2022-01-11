<template>
    <breadcrumb-component folder="Acceso" subfolder="Roles"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Roles
                <button v-show="btnCreate" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <table-component :data="roles" permission="role" @load="loadRole" />
            </div>
        </div>
    </div>

    <delete-component title="Rol" :data="role" @delete="destroyRole" />

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="save">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="name">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del Rol" v-model.trim="form.name">
                                <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" >Permisos</label>
                            <div class="col-md-9">
                                <Multiselect
                                    valueProp="id"
                                    v-model="form.permission_id"
                                     mode="tags"
                                     :searchable="true"
                                     :createTag="true"
                                    :options="permissions"
                                />
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
                    <h5 class="modal-title">Actualizar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="updatingRole">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="txtname">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" id="txtname" name="name" class="form-control" placeholder="Nombre del Rol" v-model="role.name">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" >Permisos</label>
                        <div class="col-md-9">
                            <Multiselect
                                valueProp="id"
                                v-model="role.permission_id"
                                mode="tags"
                                :searchable="true"
                                :createTag="true"
                                noResultsText="Resultados no encontrado"
                                :options="permissions"
                            />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCloseUpdate" data-dismiss="modal" @click="clear">Cerrar</button>
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
import SearchComponent from "../components/SearchComponent";
import TableComponent from "../components/TableComponent";
import Multiselect from '@vueform/multiselect'
import {computed, reactive, ref, watch} from "vue";
import {useRole} from "../composables/useRole";
import {useToast} from "../composables/useToast";
export default {
    name: "Role",
    components: {
        Multiselect,
        SearchComponent,
        TableComponent
    },
    setup(){
        const role = ref([]);
        const permissions = ref([]);
        const form = reactive({
            name : '',
            permission_id : []
        })

        const {getRoles, roles, errors, saveRole, updateRole, deleteRole, route} = useRole();
        const {successToast} = useToast();
        const permission = localStorage.getItem('permissions');
        const btnCreate = computed(() => {return permission.includes('type.create')})

        const save = async() => {
            await saveRole(form);
            await errors;
            if (errors.value.length === 0){
                await clear();
                await getRoles();
            }
        };

        const updatingRole = async () => {
            await updateRole(role.value);
            getRoles();
        };

        const destroyRole = async (id) => {
            await deleteRole(id);
            getRoles();
            successToast('Eliminado');
        }

        const loadRole = async (data) => {
            role.value = { ...data };
            await axios.get(`api/role/${role.value.id}`).then(response => {
                role.value.permission_id = response.data;
            })
        }

        const findRole = async(data) => {
            await getRoles(data);
        }

        const clear = () => {
            form.name = '';
            form.permission_id = [];
        }

        watch(() => route.query.page , () => {
            getRoles()
        })

        const loadPermission = async () => {
            await axios.get('/api/permissions').then( response => {
                permissions.value = response.data;
            })
        }

        loadPermission();
        getRoles();
        return {form, permissions, roles, role, errors, save, updatingRole, destroyRole, findRole, loadRole, btnCreate, clear}
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
