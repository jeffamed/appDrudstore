import {ref} from 'vue';
import { useRoute } from 'vue-router';
import Swal from "sweetalert2";
export function usePresentations() {
    const presentations = ref([]);
    const pagination = ref([]);
    const route = useRoute();

    const getAll = async () => {
        let res = await axios.get(`/api/presentation?page=${ route.query.page || 1}`);
        pagination.value = res.data;
        presentations.value = res.data.data;
        delete pagination.value.data;
    };

    const savePresentation = async (data) => {
        let res = await axios.post('/api/presentation', data);
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


    return { presentations, pagination, route, Toast, getAll, savePresentation, deletePresentation };
}
