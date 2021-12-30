<template>
    <div class="form-group row">
        <div class="col-md-6">
            <div class="input-group">
                <select class="form-control col-md-3" id="opcion" name="opcion" v-model="condition">
                    <option v-for="(option, key, index) in options" :key="index" :value="key" v-text="option"></option>
                </select>
                <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar" v-model="search" @keyup.enter="btnSearch">
                <button type="submit" class="btn btn-primary" @click="btnSearch"><i class="fa fa-search"></i> Buscar</button>
            </div>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";

export default {
    name: "SearchComponent",
    props:{
        options: {
            type: Object,
            default: {
                supplier: 'Proveedor',
                user: 'Usuario',
            }
        }
    },
    setup(props, context){
        const search = ref('');
        const condition = ref('supplier');

        const btnSearch = () => {
            context.emit('search', condition.value, search.value);
        }

        return {search, condition, btnSearch};
    }
}
</script>

<style scoped>

</style>
