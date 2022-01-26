import axios from "axios";

function permissionreload() {
    if(localStorage.getItem('user')){
        const user = JSON.parse(localStorage.getItem('user'));
        axios.get(`/api/verified/${user.id}`)
            .then(rsp => {
                localStorage.removeItem('permissions');
                localStorage.setItem('permissions',rsp.data);
            })
            .catch( e => console.log(e))
    }
}

export default permissionreload;
