import {ref} from 'vue';
import { useRoute } from 'vue-router';
import Swal from "sweetalert2";
export function usePresentations() {
    const errors = ref('');
    const presentations = ref([]);
    const pagination = ref([]);
    const route = useRoute();

    const getAll = async (search = '') => {
        console.log(search);
        let res = await axios.get(`/api/presentation?page=${ route.query.page || 1}&search=${ search }`);
        presentations.value = res.data.data;
        pagination.value = res.data;
        delete pagination.value.data;

    };

    const savePresentation = async (data) => {
        errors.value = '';
        try {
            let res = await axios.post('/api/presentation', data);
        }catch (e) {
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updatePresentation = async (data) => {
        errors.value = '';
        try{
            let res = await axios.put(`/api/presentation/${data.id}`,data);
            presentations.value = res.data.data;
        }catch (e) {
            if (e.response.status == 422){
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const deletePresentation = async (data) => {
        let res = await axios.delete(`/api/presentation/${data}`);
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })


    return { presentations, pagination, route, Toast, getAll, savePresentation, deletePresentation, updatePresentation };
}
