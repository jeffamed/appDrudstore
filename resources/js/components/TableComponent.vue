<template>
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th  v-for="(item,index) in header" :key="index">{{ item }}</th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="item in data" :key="item.id" v-if="data.length">
            <td v-text="item.name"></td>
            <td>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalActualizar" @click="load(item)">
                    <i class="icon-pencil"></i>
                </button> &nbsp;
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" @click="load(item)">
                    <i class="icon-trash"></i>
                </button>
            </td>
        </tr>
        <tr v-else>
            <td colspan="2" class="text-center">No hay datos Registrados</td>
        </tr>
        </tbody>
    </table>

       <!--Inicio del modal actualizar-->
        <div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-warning modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar Presentación</h5>
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
                                    <span class="help-block text-danger" v-show="errors.length">(*) {{ errors.replace('name', 'nombre') }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnCloseUpdate" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="btnUpdate">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
</template>
<script>
import {inject, reactive, ref} from "vue";

export default {
    name: "TableComponent",
    props: {
        data : {
            type: Array,
            default: []
        },
        header:{
            type: Array,
            default: ['Nombre','Opciones']
        }
    },
    setup(props, context){
        const form = reactive({
            name: '',
            id: '',
        })

        const errors = inject('errors');

        const load = (data) => {
            context.emit('load', data);
        }

        const btnUpdate = () => {
            context.emit('update', form);
        }

        return { load, form, btnUpdate, errors };
    }
}
</script>

<style scoped>
    .pagination > a.router-link-exact-active{
        color: #fff;
        background-color: #20a8d8;
        border-color: #20a8d8;
    }
</style>
