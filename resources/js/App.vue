<template>
    <header-component/>
    <div class="app-body">
        <sidebar-component/>
        <!-- Contenido Principal -->
        <div class="main">
            <router-view />
        </div>
        <!-- /Fin del contenido principal -->
    </div>

    <footer class="app-footer fixed-bottom">
        <span> &copy; 2021</span>
        <span class="ml-auto">Desarrollado por </span>
    </footer>
</template>

<script>
import HeaderComponent from "./components/HeaderComponent";
import SidebarComponent from "./components/SidebarComponent";
export default {
    name: "App",
    components: {
        HeaderComponent,
        SidebarComponent
    }
}
</script>

<style scoped>

</style>
