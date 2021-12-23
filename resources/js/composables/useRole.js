import {ref} from "vue";
import {useRoute} from "vue-router";
import {useToast} from "./useToast";

export function useRole(){
    const errors = ref('');
    const roles = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getRoles = async () => {
        let res = await axios.get('/api/role');
        roles.value = res.data;
    };

    const saveRole = async (data) => {
        try {
            errors.value = '';
            await axios.post('/api/role', data);
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

    const updateRole = async (data) => {
        try{
            errors.value = '';
            let res = await axios.put(`/api/role/${ data.id }`, data);
            roles.value = res.data.data;
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

    const deleteRole = async (data) => {
        await axios.delete(`/api/role/${data}`);
    }
    return {getRoles, roles, saveRole, updateRole, deleteRole, errors, route}
}
