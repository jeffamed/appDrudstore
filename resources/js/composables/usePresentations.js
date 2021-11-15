import {useToast} from "./useToast";
import { useRoute } from 'vue-router';
import {ref} from 'vue';

export function usePresentations() {
    const errors = ref('');
    const presentations = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getPresentations = async (search = '') => {
        let res = await axios.get(`/api/presentation?page=${ route.query.page || 1}&search=${ search }`);
        presentations.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const savePresentation = async (data) => {
        try {
            errors.value = '';
            await axios.post('/api/presentation', data);
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

    const updatePresentation = async (data) => {
        try{
            errors.value = '';
            let res = await axios.put(`/api/presentation/${ data.id }`, data);
            presentations.value = res.data.data;
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

    const deletePresentation = async (data) => {
        await axios.delete(`/api/presentation/${data}`);
    }

    return { presentations, pagination, route, getPresentations, savePresentation, deletePresentation, updatePresentation, errors };
}
