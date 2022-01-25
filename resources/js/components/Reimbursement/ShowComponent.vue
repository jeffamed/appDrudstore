<template>
    <breadcrumb-component folder="Compras" subfolder="Devoluciones   /   Detalles"/>
    <div class="row col-md-12 justify-content-center">
        <h5>Información de la Devolución</h5>
    </div>
    <div class="container pb-1 pt-2 shadow b-white">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="border border-secondary p-1">
                    <p class="font-weight-bold">Información del Proveedor</p>
                    <div class="row">
                        <div class="col-md-4">
                            <p ><span class="text-muted">R.U.C.:</span> {{ reimbursements.ruc }} </p>
                        </div>
                        <div class="col-md-8">
                            <p><span class="text-muted">Teléfono:</span> {{ reimbursements.phone }} </p>
                        </div>
                    </div>
                    <p><span class="text-muted">Nombre:</span> {{ reimbursements.supplier }} </p>
                    <p><span class="text-muted">Dirección:</span> {{ reimbursements.address }} </p>
                </div>
                <div class="border border-secondary p-1 mt-3">
                    <p class="font-weight-bold">Datos de la Devolución</p>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="font-weight-bold font-lg">Devolucion # {{ reimbursements.id }} </p>
                        </div>
                        <div class="col-md-8">
                            <p><span class="text-muted">Fecha:</span> {{ moment(reimbursements.created).format('DD/MM/Y') }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p><span class="text-muted">Total: </span> $ {{ reimbursements.total }} </p>
                        </div>
                        <div class="col-md-8">
                            <p><span class="text-muted">Observación:</span> {{ reimbursements.observation }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 my-3">
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio $</th>
                        <th>Total $</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(detail, index) in reimbursements.details" :key="index">
                        <td>{{index + 1}}</td>
                        <td>{{detail.product.name}}</td>
                        <td>{{detail.qty}}</td>
                        <td>{{detail.price}}</td>
                        <td>{{ parseFloat(detail.price * detail.qty).toFixed(2) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <router-link :to="{name: 'reimbursement'}" class="btn btn-secondary">Regresar</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import {useReimbursement} from "../../composables/useReimbursement";
import moment from "moment";
export default {
    name: "ShowComponent",
    props: {
        id : {
            required: true,
            type: String,
        }
    },
    created() {
        this.moment = moment;
    },
    setup(props){
        const {getReimbursement, reimbursements} = useReimbursement();

        getReimbursement(props.id);

        return {reimbursements};
    }
}
</script>

<style scoped>
.b-white{
    background: #ffffff;
}
ul {
    -webkit-column-count: 3;
    -moz-column-count: 3;
    column-count: 3;
}
</style>
