import {onMounted, ref} from 'vue';
export function usePresentations() {
    const presentations = ref([]);
    const pagination = ref([]);

    const getAll = async () => {
        let res = await axios.get('/api/presentations');
        pagination.value = res.data;
        presentations.value = res.data.data;
        delete pagination.value.data;
        console.log(pagination.value);
    };

    onMounted(getAll)

    return { presentations, pagination };
}
