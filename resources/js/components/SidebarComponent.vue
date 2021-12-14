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
                <li class="nav-item nav-dropdown" id="ddAlmacen" @click="openAlmacen">
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
                <li class="nav-item nav-dropdown" id="ddCompras" @click="openCompras">
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
                <li class="nav-item nav-dropdown" id="ddVentas" @click="openVentas">
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
                <li class="nav-item nav-dropdown" id="ddAcceso" @click="openAcceso">
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
                <li class="nav-item nav-dropdown" id="ddReportes" @click="openReportes">
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
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
</template>

<script>
export default {
    name: "SidebarComponent",
    setup(){
        function openAlmacen(){
            $('#ddAlmacen').addClass('open');
            $('#ddCompras').removeClass('open');
            $('#ddVentas').removeClass('open');
            $('#ddAcceso').removeClass('open');
            $('#ddReportes').removeClass('open');
        }
        function openCompras(){
            $('#ddCompras').addClass('open');
            $('#ddAlmacen').removeClass('open');
            $('#ddVentas').removeClass('open');
            $('#ddAcceso').removeClass('open');
            $('#ddReportes').removeClass('open');
        }
        function openVentas(){
            $('#ddVentas').addClass('open');
            $('#ddCompras').removeClass('open');
            $('#ddAlmacen').removeClass('open');
            $('#ddAcceso').removeClass('open');
            $('#ddReportes').removeClass('open');
        }
        function openAcceso(){
            $('#ddAcceso').addClass('open');
            $('#ddVentas').removeClass('open');
            $('#ddCompras').removeClass('open');
            $('#ddAlmacen').removeClass('open');
            $('#ddReportes').removeClass('open');
        }
        function openReportes(){
            $('#ddReportes').addClass('open');
            $('#ddAcceso').removeClass('open');
            $('#ddVentas').removeClass('open');
            $('#ddCompras').removeClass('open');
            $('#ddAlmacen').removeClass('open');
        }
        return {openAlmacen, openCompras, openVentas, openAcceso, openReportes}
    }
}
</script>
<style scoped>

</style>
