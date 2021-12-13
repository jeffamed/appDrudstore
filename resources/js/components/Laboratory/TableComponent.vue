<template>
    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th  v-for="(item, key, index) in header" :key="index">{{ item }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in data" :key="item.id" v-if="data.length">
            <td v-text="item.name"></td>
            <td v-text="item.address"></td>
            <td>
                <button v-show="btnUpdate" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalActualizar" @click="load(item)">
                    <i class="icon-pencil"></i>
                </button> &nbsp;
                <button v-show="btnDelete" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" @click="load(item)">
                    <i class="icon-trash"></i>
                </button>
            </td>
        </tr>
        <tr v-else>
            <td colspan="3" class="text-center">No hay datos Registrados</td>
        </tr>
        </tbody>
    </table>


</template>
<script>
import {computed} from "vue";

export default {
    name: "TableComponent",
    props: {
        data : {
            type: Array,
            default: []
        },
        header:{
            type: Array,
            default: ['Nombre', 'Dirección','Opciones']
        }
    },
    setup(props, context)
    {
        const load = (data) => {
            context.emit('load', data);
        }
        const permissions = localStorage.getItem('permissions');
        const btnUpdate = computed(() => {return permissions.includes('laboratory.update')})
        const btnDelete = computed(() => {return permissions.includes('laboratory.delete')})

        return { load, btnDelete, btnUpdate };
    }
}
</script>
