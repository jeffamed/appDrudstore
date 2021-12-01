<template>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <router-link :to="{ name : 'home' }" class="nav-link active" ><i class="icon-speedometer"></i> Escritorio</router-link>
                </li>
                <li class="nav-title">
                    Mantenimiento
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-social-dropbox"></i> Almacén</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="{ name : 'product' }" class="nav-link"><i class="icon-bag"></i> Productos</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'location' }" class="nav-link"><i class="icon-location-pin"></i> Ubicación</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'type' }" class="nav-link"><i class="icon-folder"></i> Tipos</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'presentation' }" class="nav-link"><i class="icon-present"></i> Presentación</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'usage' }" class="nav-link"><i class="icon-list"></i> Uso</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'laboratory' }" class="nav-link"><i class="icon-chemistry"></i> Laboratorio</router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Compras</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="{ name : 'order' }" class="nav-link"><i class="icon-wallet"></i> Ingresos</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'supplier' }" class="nav-link"><i class="icon-notebook"></i> Proveedores</router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link :to="{ name : 'sale' }" class="nav-link"><i class="icon-basket-loaded"></i> Ventas</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name : 'customer' }" class="nav-link"><i class="icon-people"></i> Clientes</router-link>

                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name : 'user' }"><i class="icon-user"></i> Usuarios</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="i#"><i class="icon-chart"></i> Reporte Ingresos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ventas</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main.html"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="main.html"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                </li>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
</template>

<script>
export default {
    name: "SidebarComponent"
}
</script>

<style scoped>

</style>
