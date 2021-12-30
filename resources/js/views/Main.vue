<template>
    <header-component/>
    <div class="app-body">
        <sidebar-component />
        <!-- Contenido Principal -->
        <div class="main">
            <router-view />
        </div>
        <!-- /Fin del contenido principal -->
    </div>
</template>
<script>
import HeaderComponent from "../components/HeaderComponent";
import SidebarComponent from "../components/SidebarComponent";
import {useAuth} from "../composables/useAuth";
export default {
    name: "Main",
    components: {
        HeaderComponent,
        SidebarComponent
    },
    setup(){
        const {verified} = useAuth();

        verified();
    }
}
</script>

<style scoped>

</style>
