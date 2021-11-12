<template>
    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th  v-for="(item, key, index) in header" :key="index">{{ item }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in data" :key="item.id" v-if="data.length">
            <td v-text="item.ruc"></td>
            <td v-text="item.name"></td>
            <td v-text="item.address"></td>
            <td v-text="item.phone"></td>
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
            <td colspan="5" class="text-center">No hay datos Registrados</td>
        </tr>
        </tbody>
    </table>


</template>
<script>
export default {
    name: "TableComponent",
    props: {
        data : {
            type: Array,
            default: []
        },
        header:{
            type: Array,
            default: ['Ruc','Nombre', 'Dirección','Teléfono','Opciones']
        }
    },
    setup(props, context)
    {
        const load = (data) => {
            context.emit('load', data);
        }

        return { load };
    }
}
</script>
