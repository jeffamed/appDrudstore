import {ref} from "vue";
import {useRoute} from "vue-router";
import {useToast} from "./useToast";

export function useSale(){
    const errors = ref('');
    const sales = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getSales = async (search = '', condition = 'user_id') => {
        let res = await axios.get(`/api/sale?page=${ route.query.page || 1}&search=${ search } &condition=${ condition }`);
        sales.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const getSale = async (data) => {
        let res = await axios.get(`/api/sale/${data}`);
        sales.value = res.data;
    };

    const saveSale = async (data) => {
        errors.value = '';
        try {
            await axios.post('/api/sale', data);
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

    const deleteSale = async (data) => {
        await axios.delete(`/api/sale/${data}`);
    }

    return { sales, pagination, route, getSales, saveSale, deleteSale, errors, getSale };
}
