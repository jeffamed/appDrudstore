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
            <td v-text="item.supplier.name"></td>
            <td class="text-center" v-text="item.order.num_order"></td>
            <td class="text-center" v-text="item.total_format"></td>
            <td class="text-center" v-text="item.status"></td>
            <td class="text-center">{{ moment(item.created_at).format('DD/MM/Y') }}</td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" @click="load(item)">
                    <i class="icon-trash"></i>
                </button>
                <router-link :to="{ name:'reimbursement.show', params: { id: item.id } }" class="btn btn-sm btn-info text-white"><i class="icon-eye"></i></router-link>
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
import moment from 'moment'
export default {
    name: "TableComponent",
    props: {
        data : {
            type: Array,
            default: []
        },
        header:{
            type: Array,
            default: ['#','Proveedor','# Compra','Total $', 'Estado', 'Registrado','Opc.']
        }
    },
    created: function () {
        this.moment = moment;
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
