import {ref} from "vue";
import {useRoute} from "vue-router";
import {useToast} from "./useToast";

export function useOrder(){
    const errors = ref('');
    const orders = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getOrders = async (search = '') => {
        let res = await axios.get(`/api/order?page=${ route.query.page || 1}&search=${ search }`);
        orders.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const saveOrder = async (data) => {
        errors.value = '';
        try {
            await axios.post('/api/order', data);
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

    const deleteOrder = async (data) => {
        await axios.delete(`/api/order/${data}`);
    }

    return { orders, pagination, route, getOrders, saveOrder, deleteOrder, errors };
}
