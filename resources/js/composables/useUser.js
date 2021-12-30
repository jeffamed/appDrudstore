import {ref} from "vue";
import {useRoute} from "vue-router";
import {useToast} from "./useToast";

export function useUser(){
    const errors = ref('');
    const users = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getUsers = async (conditon = 'name',search = '') => {
        let res = await axios.get(`/api/user?page=${ route.query.page || 1}&condition=${conditon}&search=${ search }`);
        users.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const saveUser = async (data) => {
        try {
            errors.value = '';
            await axios.post('/api/user', data);
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

    const updateUser = async (data) => {
        try{
            errors.value = '';
            let res = await axios.put(`/api/user/${ data.id }`, data);
            users.value = res.data.data;
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

    const deleteUser = async (data) => {
        await axios.delete(`/api/user/${data}`);
    }

    return {users, errors, pagination, route, getUsers, saveUser, updateUser, deleteUser};
}
