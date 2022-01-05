<template>
    <breadcrumb-component folder="Almacén" subfolder="Compras   /   Detalles"/>
    <div class="row col-md-12 justify-content-center">
        <h5>Detalles de Compra</h5>
    </div>
    <div class="container pb-1 pt-2 shadow b-white">
        <div class="row">
            <div class="col-md-6">
                <div class="border border-secondary p-1">
                    <p class="font-weight-bold text-muted">Datos de Compra</p>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold font-lg mb-0 mr-5">Compra # {{ orders.id }} </p>
                        <p class="text-muted">Fecha: {{orders.created}}</p>
                    </div>
                    <div class="d-flex">
                        <p class="w-25"><span class="text-muted">IVA:</span> {{orders.iva}}</p>
                        <p class="w-25"><span class="text-muted">SubTotal:</span> {{orders.subtotal_format}}</p>
                    </div>
                    <div class="d-flex">
                        <p class="w-25"><span class="text-muted">Descuento:</span> {{orders.discount_format}}</p>
                        <p class="w-25"><span class="text-muted">Total:</span> {{orders.total_format}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border border-secondary p-1">
                    <p class="font-weight-bold text-muted">Información del Proveedor</p>
                    <p class="font-weight-bold">R.U.C.: {{ orders.supplier.ruc }}</p>
                    <p class="font-lg">{{orders.supplier.name}} - {{orders.supplier.phone}}</p>
                    <p><span class="font-weight-bold">Dirección: </span>{{orders.supplier.address}}</p>
                </div>
            </div>
            <div class="col-md-12 my-3">
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>F.Exp.</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(detail, index) in orders.details" :key="index">
                            <th>{{index + 1}}</th>
                            <td>{{detail.product.name}}</td>
                            <td>{{detail.expire_at}}</td>
                            <td>{{detail.orderQty}}</td>
                            <td>{{detail.unitPrice}}</td>
                            <td>{{detail.discount}}</td>
                            <td>{{detail.total}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <router-link :to="{name: 'order'}" class="btn btn-secondary">Regresar</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import {useOrder} from "../../composables/useOrder";

export default {
    name: "ShowComponent",
    props: {
        id : {
            required: true,
            type: String,
        }
    },
    setup(props){
        const { getOrder, orders } = useOrder();

        getOrder(props.id);

        return {orders};
    }
}
</script>

<style scoped>
    .shadow{
        border: 0.2px solid hsl(0, 10%, 80%);
        border-radius: 5px;
        box-shadow: 7px 6px 6px 1px rgba(0,0,0,0.30);
        -webkit-box-shadow: 7px 6px 6px 1px rgba(0,0,0,0.30);
        -moz-box-shadow: 7px 6px 6px 1px rgba(0,0,0,0.30);
    }
    .b-white{
        background: #ffffff;
    }
</style>
