import {ref} from 'vue';
import { useRoute } from 'vue-router';
import Swal from "sweetalert2";
export function usePresentations() {
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
        let res = await axios.post('/api/presentation', data);
    }

    const deletePresentation = async (data) => {
        let res = await axios.delete(`/api/presentation/${data}`);
    }

    const updatePresentation = async (data) => {
        let res = await axios.put(`/api/presentation/${data.id}`,data);
        presentations.value = res.data.data;
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
