import {ref} from "vue";
import {useRoute} from "vue-router";
import {useToast} from "./useToast";

export function useReimbursement(){
    const errors = ref('');
    const reimbursements = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getReimbursements = async (search = '', condition = 'reimbursement') => {
        let res = await axios.get(`/api/reimbursement?page=${ route.query.page || 1}&search=${ search } &condition=${ condition }`);
        reimbursements.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const getReimbursement = async(data) => {
        let res = await axios.get(`/api/reimbursement/${data}`);
        reimbursements.value = res.data;
    }

    const getReimbursementSupplier = async(data) => {
        let res = await axios.get(`/api/find-reimbursements/${data}`);
        reimbursements.value = res.data;
    }

    const saveReimbursement = async (data) => {
        errors.value = '';
        try {
            await axios.post('/api/reimbursement', data);
            await successToast('Registrado')
        }catch (e) {
            errorToast();
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' / ';
                }
            }
        }
    }

    const deleteReimbursement = async (data) => {
        await axios.delete(`/api/reimbursement/${data}`);
    }

    return { reimbursements, pagination, route, getReimbursements, saveReimbursement, deleteReimbursement, errors, getReimbursement, getReimbursementSupplier };
}
