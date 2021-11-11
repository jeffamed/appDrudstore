import {reactive, ref} from "vue";
import {useRoute} from "vue-router";
import {useToast} from "./useToast";

export function useLaboratories(){
    const errors = reactive({
        name: '',
        address: ''
    });
    const laboratories = ref([]);
    const pagination = ref([]);
    const route = useRoute();
    const {successToast, errorToast} = useToast();

    const getAll = async (conditon = 'name',search = '') => {
        let res = await axios.get(`/api/laboratory?page=${ route.query.page || 1}&condition=${conditon}&search=${ search }`);
        laboratories.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;
    };

    const saveLaboratory = async (data) => {
        errors.name = '';
        errors.address = '';
        try {
            await axios.post('/api/laboratory', data);
            await successToast('Registrado');
        }catch (e) {
            errorToast();
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    if (_.has(e.response.data.errors, 'name')){
                        errors.name = e.response.data.errors['name'][0];
                    }

                    if(_.has(e.response.data.errors, 'address')) {
                        errors.address = e.response.data.errors['address'][0];
                    }
                }
            }
        }
    }

    const updateLaboratory = async (data) => {
        try{
            errors.name = '';
            errors.address = '';
            let res = await axios.put(`/api/laboratory/${ data.id }`, data);
            laboratories.value = res.data.data;
            await successToast('Actualizado');
        }catch (e) {
            errorToast();
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const deleteLaboratory = async (data) => {
        await axios.delete(`/api/laboratory/${data}`);
    }

    return { laboratories, pagination, errors, route, getAll, saveLaboratory, updateLaboratory, deleteLaboratory };
}
