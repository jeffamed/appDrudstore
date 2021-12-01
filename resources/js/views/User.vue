<template>
    <breadcrumb-component folder="Acceso" subfolder="Usuarios"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Usuarios
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
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
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Cédula</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Cédula" v-model="form.document">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Nombre del Cliente" v-model="form.name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Apellido</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Apellido del Cliente" v-model="form.last_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion del Cliente" v-model="form.address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Teléfono</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Teléfono del Cliente" v-model="form.phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Correo Electrónico</label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control" placeholder="example@emial.com" v-model="form.email">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Contraseña</label>
                        <div class="col-md-9">
                            <input type="password" name="password" class="form-control" placeholder="example" v-model="form.password">
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
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Cédula</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Cédula" v-model="user.document">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Nombre del Cliente" v-model="user.name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Apellido</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" placeholder="Apellido del Cliente" v-model="user.last_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion del Cliente" v-model="user.address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Teléfono</label>
                        <div class="col-md-9">
                            <input type="text" name="direccion" class="form-control" placeholder="Teléfono del Cliente" v-model="user.phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Correo Electrónico</label>
                        <div class="col-md-9">
                            <input type="email" name="email" class="form-control" placeholder="example@emial.com" v-model="user.email">
                            <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Contraseña</label>
                        <div class="col-md-9">
                            <input type="password" name="password" class="form-control" placeholder="example" v-model="user.password">
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
import {onMounted, reactive, ref, watch} from "vue";
import {useToast} from "../composables/useToast";
import {useUser} from "../composables/useUser";

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
            password: ''
        })
        const user = ref([]);
        const {users, pagination, errors, route, getUsers, saveUser, updateUser, deleteUser} = useUser();
        const {successToast}= useToast();

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

        return {form, users, pagination, errors, user, clear,findUser, loadUser, save, updatingUser, destroyUser};
    }
}
</script>

<style scoped>

</style>
