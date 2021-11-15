<template>
    <breadcrumb-component folder="Almacén" subfolder="Productos   /   Crear"/>
    <div class="container pb-3 pt-2" style="background: #ffffff">
        <div class="row col-md-12 justify-content-center">
            <h5>Registrar Producto</h5>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="form-control-label" for="code">Codigo</label>
                <input type="text" name="code" class="form-control" placeholder="Codigo del Producto" v-model="form.code">
            </div>
            <div class="col-md-8">
                <label class="ml-3 form-control-label" for="name">Nombre</label>
                <input type="text" name="name" class="form-control" placeholder="Nombre del Producto" v-model="form.name">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="form-control-label" for="price">Precio</label>
                <input type="number" name="price" step=".01" min="0" class="form-control" placeholder="0.0" v-model="form.price">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="cost">Costo</label>
                <input type="number" name="cost" step=".01" min="0" class="form-control" placeholder="0.0" v-model="form.cost">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="discount">Descuento</label>
                <input type="number" name="discount" step=".01" min="0" class="form-control" placeholder="0.0" v-model="form.discount">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="form-control-label" for="supplier">Proveedor</label>
                <input type="text" name="supplier" class="form-control" placeholder="Proveedor del Producto">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="laboratory">Laboratorio</label>
                <input type="text" name="laboratory" class="form-control" placeholder="Laboratorio del Producto">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="presentation">Presentación</label>
                <input type="text" name="presentation" class="form-control" placeholder="Presentacion del Producto">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="form-control-label" for="laboratory">Ubicación</label>
                <input type="text" name="laboratory" class="form-control" placeholder="Ubicación del Producto">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="type">Tipo</label>
                <input type="text" name="type" class="form-control" placeholder="Tipo del Producto">
            </div>
            <div class="col-md-4">
                <label class="form-control-label" for="expire_at">Fecha de Expiración</label>
                <input type="date" name="expire_at" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <hr>
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Seleccione los usos
            </a>
            <hr>
            <div class="collapse show mx-3" id="collapseExample">
                <div class="card card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                </div>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <router-link :to="{ name: 'product' }" class="btn btn-danger float-right"> Cancelar</router-link>
                <button class="btn btn-success mr-2 float-right">Guardar</button>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive} from "vue";

export default {
    name: "CreateComponent",
    setup(){
        const form = reactive({
            code: '',
            name: '',
            price: 0,
            cost: 0,
            discount: 0,
            stock: 0,
            box_stock: 0,
            expire_at: new Date(),
            supplier_id: 0,
            laboratory_id: 0,
            type_id: 0,
            location_id: 0,
            presentation_id: 0,
        })

        return {form};
    }
}
</script>

<style scoped>

</style>
