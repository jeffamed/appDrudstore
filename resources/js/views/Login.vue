<template>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center h-100vh">
            <div class="card border border-primary rounded rounded-lg">
                <div class="card-header text-center  border-primary" style="background: transparent">
                    <h3>Iniciar Sesión</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-3 form-control-label font-weight-bold" for="email">Email</label>
                                <div class="col-md-12">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" v-model="form.email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-3 form-control-label font-weight-bold" for="pass">Contraseña</label>
                                <div class="col-md-12">
                                    <input type="password" name="pass" id="pass" class="form-control" placeholder="******" v-model="form.password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success" @click="login">Acceder</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, ref} from 'vue';
import {useRouter} from 'vue-router';
import {useAuth} from "../composables/useAuth";
export default {
    name: "Login",
    setup(){
        const form = reactive({
            email: '',
            password: ''
        })

        const errors = ref('');
        const router = useRouter();
        const {verified} = useAuth();

        const login = async () => {
           errors.value = '';
           await axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/login', form).then(rsp => {
                    localStorage.setItem('user', JSON.stringify(rsp.data));
                    router.push({ name: 'home'})
                }).catch(e => {
                    if (e.response.status == 422){
                        for (const key in e.response.data.errors) {
                            errors.value += e.response.data.errors[key][0] + ' / ';
                        }
                    }
                    return errors.value;
                })
            });
        }



        verified();
        return {form, login, errors}
    }
}
</script>

<style scoped>
    .h-100vh{
        height: 100vh;
    }
</style>
