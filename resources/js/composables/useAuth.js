import {useRouter} from "vue-router";
import {ref} from "vue";

export function useAuth(){
    const router = useRouter();
    const auth = ref('');

    const verified = async () => {
        const rsp = await axios.get('/api/verified');
        auth.value = rsp.data;
        if (rsp.data !== 'unauthorization'){
            router.push({ name: 'home' })
        }
    }

    const logout = async () => {
        let rsp = await axios.post('/api/logout');
        localStorage.removeItem('user');
        localStorage.removeItem('permissions');
        router.push({ name: 'login'});
    }

    return {verified, auth, logout}
}
