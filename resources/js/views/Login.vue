<template>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center h-100vh">
            <div class="card border border-primary rounded rounded-lg">
            <div class="py-4" style="background-color: #0082ca; background-image: url('./img/LogoFarma.png'); background-position: center; background-repeat: no-repeat"></div>
                <div class="card-header text-center  border-primary" style="background: transparent">
                    <h3>Iniciar Sesión</h3>
                </div>
                <form @submit.prevent="login">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-6 form-control-label font-weight-bold" for="email">Correo electrónico</label>
                                    <div class="col-md-12">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@hotmail.com" v-model="form.email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 form-control-label font-weight-bold" for="pass">Contraseña</label>
                                    <div class="col-md-12">
                                        <input type="password" name="pass" id="pass" class="form-control" placeholder="******" v-model="form.password" @keyup.enter="login">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="help-block text-danger" v-show="errors.length">(*) {{ errors }}</span>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Acceder</button>
                        </div>
                    </div>
                    <div class="card-footer py-4" style="background-color: #0082ca; background-image: url('./img/LogoFarma.png'); background-position: center; background-repeat: no-repeat">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, ref} from 'vue';
import {useRouter} from 'vue-router';
import moment from 'moment';
export default {
    name: "Login",
    created: function () {
        this.moment = moment;
    },
    setup(){
        const form = reactive({
            email: '',
            password: ''
        })

        const errors = ref('');
        const router = useRouter();

        const login = async () => {
           errors.value = '';
           await axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/login', form).then(rsp => {
                    delete rsp.data.created_at
                    delete rsp.data.updated_at
                    delete rsp.data.address
                    delete rsp.data.document
                    delete rsp.data.phone
                    delete rsp.data.delete_at
                    delete rsp.data.email_verified_at
                    window.Laravel = {
                        csrfToken : rsp.data.token.replace(/['"]+/g, ''),
                        user: rsp.data,
                        permissions: rsp.data.permissions
                    }
                    localStorage.setItem('token', JSON.stringify(rsp.data.token).replace(/['"]+/g, ''));
                    localStorage.setItem('user', JSON.stringify(rsp.data));
                    localStorage.setItem('permissions', JSON.stringify(rsp.data.permissions));

                    localStorage.setItem('time_session', moment().add(1, 'days').format('Y-MM-DD'));
                    router.push({ name: 'dashboard'})
                }).catch(e => {
                    errors.value = '';
                    if (e.response.status == 422){
                        for (const key in e.response.data.errors) {
                            errors.value += e.response.data.errors[key][0] + ' / ';
                        }
                    }
                    if(e.response.status === 500){
                        errors.value = 'Su usuario no cuenta con un rol';
                    }
                    return errors.value;
                })
            });
        }

        return {form, login, errors}
    }
}
</script>

<style scoped>
    .h-100vh{
        height: 100vh;
    }
</style>
