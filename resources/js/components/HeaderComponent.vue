<template>
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0)" @click="dashboard"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-md-down-none"> {{ user.full_name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="#" @click="logout"><i class="fa fa-lock"></i> Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </header>
</template>

<script>
import {useAuth} from "../composables/useAuth";

export default {
    name: "HeaderComponent",
    setup(){
        const user = JSON.parse(localStorage.getItem('user'));
        const {logout, router} = useAuth();

        const dashboard = () => {
          router.push({name : 'dashboard'});
        }

        return {logout, user, dashboard}
    }
}
</script>

<style scoped>

</style>
