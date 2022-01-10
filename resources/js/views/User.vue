<template>
    <breadcrumb-component folder="Acceso" subfolder="Usuarios"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Usuarios
                <button v-show="btnCreate" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <search-component @search="findUser" />
                <table-component :data="users" @load="loadUser" />
                <pagination-component name="user" :pagination="pagination"/>
            </div>
        </div>
    </div>

    <delete-component title="Usuario" :data="user" @delete="destroyUser" />

    <!-- modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="col-md-3 form-control-label p-0">Nombre</label>
                            <input type="text" name="name" class="form-control" placeholder="Nombre del Usuario" v-model="form.name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-control-label">Apellido</label>
                            <input type="text" name="name" class="form-control" placeholder="Apellido del Usuario" v-model="form.last_name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-control-label">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="ejemplo@hotmail.com" v-model="form.email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-control-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" v-model="form.password">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-control-label">Roles</label>
                            <select v-model="form.rol_id" class="form-control">
                                <option value="">Seleccione un Rol...</option>
                                <option :value="role.id" v-for="role in roles" :key="role.id" v-text="role.name"></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-9">
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

    <!-- modal actualizar-->
    <div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-warning modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="col-md-3 form-control-label p-0">Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Nombre del Usuario" v-model="user.name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-control-label">Apellido</label>
                        <input type="text" name="name" class="form-control" placeholder="Apellido del Usuario" v-model="user.last_name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-control-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" placeholder="ejemplo@hotmail.com" v-model="user.email">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-control-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" v-model="user.password">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-control-label">Roles</label>
                        <select v-model="user.rol_id" class="form-control">
                            <option value="">Seleccione un Rol</option>
                            <option :value="role.id" v-for="role in roles" :key="role.id" v-text="role.name"></option>
                        </select>
                    </div>
                </div>
                    <div class="form-group row">
                        <div class="col-md-9">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clear">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="updatingUser">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->

</template>

<script>
import TableComponent from "../components/User/TableComponent";
import SearchComponent from "../components/User/SearchComponent";
import {computed, onMounted, reactive, ref, watch} from "vue";
import {useToast} from "../composables/useToast";
import {useUser} from "../composables/useUser";
import {useRole} from "../composables/useRole";

export default {
    name: "User",
    components: {
        TableComponent,
        SearchComponent
    },
    setup(){
        const form = reactive({
            document: '',
            name: '',
            last_name: '',
            address: '',
            phone: '',
            email: '',
            password: '',
            rol_id: ''
        })
        const user = ref([]);
        const {users, pagination, errors, route, getUsers, saveUser, updateUser, deleteUser} = useUser();
        const { getRoles, roles } = useRole();
        const {successToast}= useToast();
        const permissions = localStorage.getItem('permissions');
        const btnCreate = computed(() => {return permissions.includes('user.create')})

        const save = async () => {
            await saveUser(form);
            await errors;
            if(errors.value.length === 0 ){
                await clear()
                await getUsers();
            }
        }

        const updatingUser = async () => {
            await updateUser(user.value);
            await getUsers();
        }

        const destroyUser = async (id) => {
            await deleteUser(id);
            await getUsers();
            await successToast('Eliminado');
        }

        const findUser = async(condition, search) => {
            await getUsers(condition, search);
        }

        const loadUser = async (data) => {
            user.value = { ...data };
        }

        const clear = () => {
            form.document = '';
            form.name = '';
            form.last_name = '';
            form.address = '';
            form.phone = '';
            form.email = '';
            form.password = '';
        }

        watch( () => route.query.page, ()=>{
            getUsers();
        });

        onMounted(getUsers());
        getRoles();

        return {form, users, pagination, errors, user, clear,findUser, loadUser, save, updatingUser, destroyUser, btnCreate, roles};
    }
}
</script>

<style scoped>

</style>
