<template>
    <breadcrumb-component folder="Compras" subfolder="Devolución"/>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Devoluciones
                <router-link :to="{ name: 'reimbursement.create' }" class="btn btn-secondary"><i class="icon-plus"></i> Nuevo</router-link>
            </div>
            <div class="card-body">
                <search-component @search="findReimbursement" />
                <table-component :data="reimbursements"  @load="loadReimbursement" />
                <pagination-component name="reimbursement" :pagination="pagination" />
            </div>
        </div>
    </div>

    <delete-component title="Devolución" :data="reimbursement" @delete="destroyReimbursement"/>
</template>

<script>
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import TableComponent from "../components/Reimbursement/TableComponent";
import DeleteComponent from "../components/Reimbursement/DeleteComponent";
import SearchComponent from "../components/Reimbursement/SearchComponent";
import {computed, ref, watch} from "vue";
import {useToast} from "../composables/useToast";
import {useReimbursement} from "../composables/useReimbursement";
export default {
    name: "Reimbursement",
    components: {
        BreadcrumbComponent,
        TableComponent,
        DeleteComponent,
        SearchComponent
    },
    setup(){
        const reimbursement = ref([]);

        const {getReimbursements, pagination, reimbursements, route, deleteReimbursement} = useReimbursement();
        const { successToast } = useToast();
        const permissions = localStorage.getItem('permissions');
        const btnCreate = computed(() => {return permissions.includes('order.create')})

        const loadReimbursement = (data) => {
            reimbursement.value = { ...data };
        }

        const findReimbursement = async(condition, search) => {
            await getReimbursements(search, condition);
        }

        const destroyReimbursement = async(id) =>{
            await deleteReimbursement(id);
            await getReimbursements();
            successToast('Eliminado')
        };

        getReimbursements();

        watch(() => route.query.page, ()=>{
            return getReimbursements();
        })

        return {reimbursements, pagination, loadReimbursement, reimbursement, destroyReimbursement, findReimbursement, btnCreate}
    }
}
</script>

<style scoped>

</style>
