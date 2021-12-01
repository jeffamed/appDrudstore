<template>
    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th  v-for="(item,index) in header" :key="index">{{ item }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in data" :key="item.id" v-if="data.length">
            <td v-text="item.description"></td>
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
            default: ['Descripción','Opciones']
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

<style scoped>
.pagination > a.router-link-exact-active{
    color: #fff;
    background-color: #20a8d8;
    border-color: #20a8d8;
}
</style>
