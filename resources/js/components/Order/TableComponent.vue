<template>
    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th  v-for="(item, key, index) in header" :key="index">{{ item }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in data" :key="item.id" v-if="data.length">
            <td v-text="item.user"></td>
            <td v-text="item.supplier"></td>
            <td v-text="item.iva"></td>
            <td v-text="item.subtotal"></td>
            <td v-text="item.total"></td>
            <td v-text="item.created_at"></td>
            <td>
                <router-link class="btn btn-warning btn-sm" :to="{ name: 'product.edit', params: { id: item.id } }"><i class="icon-pencil"></i></router-link>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" @click="load(item)">
                    <i class="icon-trash"></i>
                </button>
            </td>
        </tr>
        <tr v-else>
            <td colspan="7" class="text-center">No hay datos Registrados</td>
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
            default: ['Usuario', 'Proveedor','IVA','SubTotal', 'Total', 'Registrado','Opciones']
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
