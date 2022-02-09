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
            <td v-text="item.user.name"></td>
            <td v-text="item.cliente"></td>
            <td class="text-center" v-text="item.subtotal_format"></td>
            <td class="text-center" v-text="item.discount_format"></td>
            <td class="text-center"> {{ parseFloat(item.iva).toFixed(2) }}</td>
            <td class="text-center" v-text="item.total_format"></td>
            <td class="text-center" v-text="item.created"></td>
            <td class="text-center">
                <button v-show="btnDelete" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" @click="load(item)">
                    <i class="icon-trash"></i>
                </button>
                <router-link :to="{ name:'sale.show', params: { id: item.id } }" class="btn btn-sm btn-info text-white"><i class="icon-eye"></i></router-link>
                <button class="btn btn-sm btn-success" @click="download(item.id,item.cliente)"><span class="icon-cloud-download"></span></button>
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
            default: ['#','Usuario', 'Cliente','SubTotal $','Descuento $','IVA $','Total $', 'Registrado','Opc.']
        }
    },
    setup(props, context)
    {
      const permissions = localStorage.getItem('permissions');
      const btnDelete = computed(() => {return permissions.includes('sale.delete')})
        const load = (data) => {
            context.emit('load', data);
        }

        const download = (id, customer) => {
            axios({ url: `/api/invoice/${id}`, method: 'GET', responseType: 'blob'})
                .then(response=>{
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', `Factura-${customer}.pdf`);
                    document.body.appendChild(link);
                    link.click();
                });
        }
        return { load, btnDelete, download };
    }
}
</script>

<style scoped>

</style>
