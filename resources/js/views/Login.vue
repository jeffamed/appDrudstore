<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Iniciar Sesión
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3 form-control-label" for="email">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" v-model="form.email">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3 form-control-label" for="pass">Contraseña</label>
                            <div class="col-md-9">
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="******" v-model="form.password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success" @click="login">Acceder</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive} from 'vue';
export default {
    name: "Login",
    setup(){
        const form = reactive({
            email: '',
            password: ''
        })

        const login = async () => {
            let rsp = await axios.post('login', form);
            console.log(rsp)
        }

        return {form, login}
    }
}
</script>

<style scoped>


</style>
