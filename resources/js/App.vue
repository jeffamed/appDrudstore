<template>
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#" data-toggle="dropdown">
                    <i class="icon-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Notificaciones</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-envelope-o"></i> Ingresos
                        <span class="badge badge-success">3</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-tasks"></i> Ventas
                        <span class="badge badge-danger">2</span>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="d-md-down-none">admin </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Perfil</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </header>

    <div class="app-body">
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
                                <a class="nav-link" href="i#"><i class="icon-user"></i> Usuarios</a>
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
export default {
    name: "App",
}
</script>

<style scoped>

</style>
