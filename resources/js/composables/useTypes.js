import {ref} from "vue";
import {useRoute} from "vue-router";
import {useToast} from "./useToast";

export function useTypes() {

    const errors = ref('');
    const types = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getAll = async (search = '') => {
        let res = await axios.get(`/api/type?page=${ route.query.page || 1}&search=${ search }`);
        types.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const saveType = async (data) => {
        try {
            errors.value = '';
            await axios.post('/api/type', data);
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

    const updateType = async (data) => {
        try{
            errors.value = '';
            let res = await axios.put(`/api/type/${ data.id }`, data);
            types.value = res.data.data;
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

    const deleteType = async (data) => {
        await axios.delete(`/api/type/${data}`);
    }

    return {types, pagination, route, errors, getAll, saveType, updateType, deleteType};
}
