<template>
    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th class="text-center" v-for="(item, key, index) in header" :key="index">{{ item }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in data" :key="item.id" v-if="data.length">
            <td v-text="item.id"></td>
            <td v-text="item.user.name"></td>
            <td v-text="item.proveedor"></td>
            <td class="text-center" v-text="item.iva"></td>
            <td class="text-center" v-text="item.subtotal_format"></td>
            <td class="text-center" v-text="item.discount_format"></td>
            <td class="text-center" v-text="item.total_format"></td>
            <td class="text-center" v-text="item.created"></td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" @click="load(item)">
                    <i class="icon-trash"></i>
                </button>
            </td>
        </tr>
        <tr v-else>
            <td colspan="9" class="text-center">No hay datos Registrados</td>
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
            default: ['Compra','Usuario', 'Proveedor','IVA','SubTotal','Descuento','Total', 'Registrado','Opc.']
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

</style>
