<template>
    <breadcrumb-component folder="Almacén" subfolder="Productos   /   Detalles"/>
    <div class="row col-md-12 justify-content-center">
        <h5>Información del Producto</h5>
    </div>
    <div class="container pb-1 pt-2 shadow b-white">
        <div class="row">
            <div class="col-md-12">
                <div class="border border-secondary p-1">
                    <h4 class="font-weight-bold mr-5 text-center" v-text="product.name"> </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="text-muted">Código # </span> {{ product.code }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="text-muted">Existencia Actual:</span> {{ product.stock }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="text-muted">Precio de Venta :</span>$ {{ product.price }} </p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="text-muted">Precio de Compra:</span>$ {{ product.cost }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="text-muted">Ubicación:</span> {{product.ubicacion}} </p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="text-muted">Presentación:</span> {{product.presentacion}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="text-muted">Tipo:</span> {{product.tipo}}</p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="text-muted">Fecha Expiración:</span> {{moment(product.expire_at).format('DD/MM/Y')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-3">
                <div class="border border-secondary p-1">
                    <p class="font-weight-bold">Información del Proveedor</p>
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="text-muted">R.U.C.:</span> {{sup.ruc}} </p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="text-muted">Teléfono:</span> {{sup.phone}}</p>
                        </div>
                    </div>
                    <p><span class="text-muted">Nombre:</span> {{sup.name}}</p>
                    <p><span class="text-muted">Dirección:</span> {{sup.address}}</p>
                </div>
            </div>
            <div class="col-md-6 my-3">
                <div class="border border-secondary p-1">
                    <p class="font-weight-bold">Información del Laboratorio</p>
                    <p><span class="text-muted">Nombre:</span> {{lab.name}}</p>
                    <p><span class="text-muted">Dirección: </span> {{lab.address}}</p>
                    <p></p>
                </div>
            </div>
            <div class="col-md-12 my-3">
                <div class="border border-secondary p-1">
                    <p class="text-center font-weight-bold">Usos del Producto</p>
                    <ul>
                        <li v-for="usage in product.usages" :key="usage.id">{{usage.description}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <router-link :to="{name: 'product'}" class="btn btn-secondary">Regresar</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import {useProducts} from "../../composables/useProducts";
import {computed, ref, watch} from "vue";
import moment from 'moment';

export default {
    name: "ShowComponent",
    props: {
        id: {
            required: true,
            type: Number
        }
    },
    created: function () {
        this.moment = moment;
    },
    setup(props){
        const {product, lab, sup, getProduct} = useProducts();

        getProduct(props.id)

        return{ product, lab, sup }
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
