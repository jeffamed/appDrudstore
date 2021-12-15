<template>
    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr class="text-center">
            <th  v-for="(item, key, index) in header" :key="index" :class="item === 'Opciones' ? 'text-center' : ''" >{{ item }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in data" :key="item.id" v-if="data.length">
            <td v-text="item.code"></td>
            <td v-text="item.name"></td>
            <td v-text="item.price"></td>
            <td v-text="item.cost"></td>
            <td v-text="item.stock"></td>
            <td v-text="item.box_stock"></td>
            <td class="text-center">
                <router-link v-show="btnUpdate" class="btn btn-warning btn-sm" :to="{ name: 'product.edit', params: { id: item.id } }"><i class="icon-pencil"></i></router-link>
                <button v-show="btnDelete" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" @click="load(item)">
                    <i class="icon-trash"></i>
                </button>
                <router-link class="btn btn-info btn-sm" :to="{ name: 'product.show', params: { id: item.id } }"><i class="icon-eye"></i></router-link>
            </td>
        </tr>
        <tr v-else>
            <td colspan="7" class="text-center">No hay datos Registrados</td>
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
            default: ['Codigo', 'Nombre','Precio','Costo', 'Existencia', 'Exist. Caja','Opciones']
        }
    },
    setup(props, context)
    {
        const permissions = localStorage.getItem('permissions');
        const btnUpdate = computed(() => {return permissions.includes('product.update')})
        const btnDelete = computed(() => {return permissions.includes('product.delete')})

        const load = (data) => {
            context.emit('load', data);
        }

        return { load, btnDelete, btnUpdate };
    }
}
</script>

