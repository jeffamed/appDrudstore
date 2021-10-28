<template>
    <breadcrumb-component folder="Almacén" subfolder="Presentación"/>
    <table-component title="Presentación" :data="presentations" :pagination="pagination"/>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Presentación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Nombre de presentación" v-model="form.name">
                                <span class="help-block">(*) Ingrese el nombre de la categoría</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
import { reactive, watch, onMounted } from "vue";
import Swal from 'sweetalert2';
export default {
    components: {
        BreadcrumbComponent,
        TableComponent
    },
    setup(){
        const form = reactive({
            name : ''
        })
        const {presentations, pagination, route, getAll, savePresentation, Toast} = usePresentations();

        const save = async() => {
            await savePresentation(form);
            await clear();
            await getAll();
            Toast.fire({
                icon: 'success',
                title: 'Registrado Exitosamente'
            })
        }

        const clear = () => {
            form.name = '';
        }

        // sirve para cargar los datos en el momento
        onMounted(getAll);

        // watch para observar el cambio de la variable route y ejecuta la funcion nuevamente
        watch(route, () => {
            getAll()
        })
        return { presentations, pagination, route, getAll, save, form};
    }
}
</script>

<style scoped>

</style>
