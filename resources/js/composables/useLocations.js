import {useToast} from "./useToast";
import { useRoute } from 'vue-router';
import {ref} from 'vue';

export function useLocations() {
    const errors = ref('');
    const locations = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getAll = async (search = '') => {
        let res = await axios.get(`/api/location?page=${ route.query.page || 1}&search=${ search }`);
        locations.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const saveLocation = async (data) => {
        try {
            errors.value = '';
            await axios.post('/api/location', data);
            await successToast('Registrado')
        }catch (e) {
            errors.value = '';
            errorToast;
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updateLocation = async (data) => {
        try{
            errors.value = '';
            let res = await axios.put(`/api/location/${ data.id }`, data);
            locations.value = res.data.data;
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

    const deleteLocation = async (data) => {
        await axios.delete(`/api/location/${data}`);
    }

    return { locations, pagination, route, getAll, saveLocation, deleteLocation, updateLocation, errors };
}
