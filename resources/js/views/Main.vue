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
import Sidebar2Component from "../components/Sidebar2Component";
export default {
    name: "Main",
    components: {
        Sidebar2Component,
        HeaderComponent,
        SidebarComponent
    }
}
</script>

<style scoped>

</style>
