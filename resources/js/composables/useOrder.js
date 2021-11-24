import {ref} from "vue";
import {useRoute} from "vue-router";
import {useToast} from "./useToast";

export function useOrder(){
    const errors = ref('');
    const order = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getOrders = async (search = '') => {
        let res = await axios.get(`/api/order?page=${ route.query.page || 1}&search=${ search }`);
        presentations.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const saveOrder = async (data) => {
        try {
            errors.value = '';
            await axios.post('/api/order', data);
            await successToast('Registrado')
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


    const deleteOrder = async (data) => {
        await axios.delete(`/api/order/${data}`);
    }

    return { order, pagination, route, getOrders, saveOrder, deletePresentation, errors };
}
