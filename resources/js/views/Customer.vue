<template>
    <breadcrumb-component folder="Ventas" subfolder="Clientes"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Clientes
                <button  v-show="btnCreate" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <search-component @search="findCustomer" />
                <table-component :data="customers" @load="loadCustomer" />
                <pagination-component name="customer" :pagination="pagination"/>
            </div>
        </div>
    </div>

    <delete-component title="Cliente" body="al cliente" :data="customer.full_name" @delete="destroyCustomer" />

    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="save">
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
                                <input type="text" name="direccion" class="form-control" placeholder="Dirección del Cliente" v-model="form.address">
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
                                <input type="email" name="email" class="form-control" placeholder="ejemplo@hotmail.com" v-model="form.email">
                                <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
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
                    <h5 class="modal-title">Actualizar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="updatingCustomer">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Cédula</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Cédula" v-model="customer.document">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Nombre del Cliente" v-model="customer.name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Apellido</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Apellido del Cliente" v-model="customer.last_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                            <div class="col-md-9">
                                <input type="text" name="direccion" class="form-control" placeholder="Dirección del Cliente" v-model="customer.address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Teléfono</label>
                            <div class="col-md-9">
                                <input type="text" name="direccion" class="form-control" placeholder="Teléfono del Cliente" v-model="customer.phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Correo Electrónico</label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control" placeholder="ejemplo@hotmail.com" v-model="customer.email">
                                <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
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

</template>

<script>
import TableComponent from "../components/Customer/TableComponent";
import SearchComponent from "../components/Customer/SearchComponent";
import {computed, onMounted, reactive, ref, watch} from "vue";
import {useCustomer} from "../composables/useCustomer";
import {useToast} from "../composables/useToast";

export default {
    name: "Customer",
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
        })
        const customer = ref([]);
        const {customers, pagination, errors, route, getCustomers, saveCustomer, updateCustomer, deleteCustomer} = useCustomer();
        const {successToast}= useToast();
        const permissions = localStorage.getItem('permissions');
        const btnCreate = computed(() => {return permissions.includes('customer.create')})

        const save = async () => {
            await saveCustomer(form);
            await errors;
            if(errors.value.length === 0 ){
                await clear()
                await getCustomers();
            }
        }

        const updatingCustomer = async () => {
            await updateCustomer(customer.value);
            await getCustomers();
        }

        const destroyCustomer = async (id) => {
            await deleteCustomer(id);
            await getCustomers();
            await successToast('Eliminado');
        }

        const findCustomer = async(condition, search) => {
            await getCustomers(condition, search);
        }

        const loadCustomer = async (data) => {
            customer.value = { ...data };
        }

        const clear = () => {
            form.document = '';
            form.name = '';
            form.last_name = '';
            form.address = '';
            form.phone = '';
            form.email = '';
        }

        watch( () => route.query.page, ()=>{
            getCustomers();
        });

        onMounted(getCustomers);

        return {form, customers, pagination, errors, customer, clear,findCustomer, loadCustomer, save, updatingCustomer, destroyCustomer, btnCreate};
    }
}
</script>

<style scoped>

</style>
