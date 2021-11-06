import {useToast} from "./useToast";
import {ref} from "vue";
import {useRoute} from "vue-router";

export function useUsages()
{
    const errors = ref('');
    const usages = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getAll = async (search = '') => {
        let res = await axios.get(`/api/usage?page=${ route.query.page || 1}&search=${ search }`);
        usages.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const saveUsage = async (data) => {
        try {
            errors.value = '';
            await axios.post('/api/usage', data);
            await successToast('Registrado')
        }catch (e) {
            errorToast();
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updateUsage = async (data) => {
        try{
            errors.value = '';
            let res = await axios.put(`/api/usage/${ data.id }`, data);
            usages.value = res.data.data;
            await successToast('Actualizado');
            $('#btnCloseUpdate').click();
        }catch (e) {
            errorToast();
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const deleteUsage = async (data) => {
        await axios.delete(`/api/usage/${data}`);
    }

    return { usages, pagination, route, getAll, saveUsage, deleteUsage, updateUsage, errors };
}
