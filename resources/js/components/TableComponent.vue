<template>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ title }}
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                                <option value="nombre">Nombre</option>
                                <option value="descripcion">Descripción</option>
                            </select>
                            <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Opciones</th>
                        <th>Nombre</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in data" :key="item.id" v-if="data.length">
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                <i class="icon-pencil"></i>
                            </button> &nbsp;
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                <i class="icon-trash"></i>
                            </button>
                        </td>
                        <td v-text="item.name"></td>
                    </tr>
                    <tr v-else>
                        <td colspan="2" class="text-center">No hay datos Registrados</td>
                    </tr>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-for="page in pagination.last_page">
                            <router-link :to="{ name: 'presentation', query : { page : page } }"  class="page-link" >{{ page }}</router-link>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
</template>
<script>
export default {
    name: "TableComponent",
    props: {
        title : {
            type: String,
            default: 'Titulo'
        },
        data : {
            type: Array,
            default: []
        },
        pagination : {
            type: Object,
            default: []
        }
    }
}
</script>

<style scoped>
    .pagination > a.router-link-exact-active{
        color: #fff;
        background-color: #20a8d8;
        border-color: #20a8d8;
    }
</style>
