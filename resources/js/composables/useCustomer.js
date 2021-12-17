import {ref} from "vue";
import {useRoute} from "vue-router";
import {useToast} from "./useToast";

export function useCustomer(){
    const errors = ref('');
    const customers = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getCustomers = async (conditon = 'name',search = '') => {
        let res = await axios.get(`/api/customer?page=${route.query.page || 1}&condition=${conditon}&search=${search}`);
        customers.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const allCustomers = async() => {
        let res = await axios.get('/api/customer-all');
        customers.value = res.data;
    }

    const saveCustomer = async (data) => {
        try {
            errors.value = '';
            await axios.post('/api/customer', data);
            await successToast('Registrado');
        }catch (e) {
            errors.value = '';
            errorToast();
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0]+' ';
                }
            }
        }
    }

    const updateCustomer = async (data) => {
        try{
            errors.value = '';
            let res = await axios.put(`/api/customer/${ data.id }`, data);
            customers.value = res.data.data;
            await successToast('Actualizado');
        }catch (e) {
            errors.value = '';
            errorToast();
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const deleteCustomer = async (data) => {
        await axios.delete(`/api/customer/${data}`);
    }

    return {customers, errors, pagination, route, getCustomers, saveCustomer, updateCustomer, deleteCustomer, allCustomers};
}
