<template>
    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th class="text-center" v-for="(item, key, index) in header" :key="index">{{ item }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in data" :key="item.id" v-if="data.length">
            <td class="text-center" v-text="item.id"></td>
            <td class="text-center" v-text="item.num_order"></td>
            <td v-text="item.user.name"></td>
            <td v-text="item.proveedor"></td>
            <td class="text-center" v-text="item.subtotal_format"></td>
            <td class="text-center">{{ parseFloat(item.iva).toFixed(2) }}</td>
            <td class="text-center" v-text="item.total_format"></td>
            <td class="text-center" v-text="item.created"></td>
            <td class="text-center">
                <button v-show="btnDelete" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" @click="load(item)">
                    <i class="icon-trash"></i>
                </button>
                <router-link :to="{name:'order.show', params: { id: item.id } }" class="btn btn-sm btn-info text-white"><i class="icon-eye"></i></router-link>
            </td>
        </tr>
        <tr v-else>
            <td colspan="9" class="text-center">No hay datos Registrados</td>
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
            default: ['#','# Factura','Usuario', 'Proveedor','SubTotal $','IVA $','Total $', 'Registrado','Opc.']
        }
    },
    setup(props, context)
    {
        const permissions = localStorage.getItem('permissions');
        const btnDelete = computed(() => {return permissions.includes('order.delete')})
        const load = (data) => {
            context.emit('load', data);
        }

        return { load, btnDelete };
    }
}
</script>

<style scoped>

</style>
