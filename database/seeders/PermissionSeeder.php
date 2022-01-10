<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'customer',
            'label' => 'Cliente'
        ]);
        DB::table('permissions')->insert([
            'name' => 'customer.create',
            'label' => 'Crear Cliente'

        ]);
        DB::table('permissions')->insert([
            'name' => 'customer.update',
            'label' => 'Actualizar Cliente'

        ]);
        DB::table('permissions')->insert([
            'name' => 'customer.delete',
            'label' => 'Eliminar Cliente'
        ]);
        DB::table('permissions')->insert([
            'name' => 'laboratory',
            'label' => 'Laboratorio'
        ]);
        DB::table('permissions')->insert([
            'name' => 'laboratory.create',
            'label' => 'Crear Laboratorio'
        ]);
        DB::table('permissions')->insert([
            'name' => 'laboratory.update',
            'label' => 'Actualizar Laboratorio'
        ]);
        DB::table('permissions')->insert([
            'name' => 'laboratory.delete',
            'label' => 'Eliminar Laboratorio'
        ]);
        DB::table('permissions')->insert([
            'name' => 'location',
            'label' => 'Ubicacion'
        ]);
        DB::table('permissions')->insert([
            'name' => 'location.create',
            'label' => 'Crear Ubicacion'
        ]);
        DB::table('permissions')->insert([
            'name' => 'location.update',
            'label' => 'Actualizar Ubicacion'
        ]);
        DB::table('permissions')->insert([
            'name' => 'location.delete',
            'label' => 'Eliminar Ubicacion'
        ]);
        DB::table('permissions')->insert([
            'name' => 'order',
            'label' => 'Compras',
        ]);
        DB::table('permissions')->insert([
            'name' => 'order.create',
            'label' => 'Crear Compras',
        ]);
        DB::table('permissions')->insert([
            'name' => 'order.delete',
            'label' => 'Eliminar Compras',
        ]);
        DB::table('permissions')->insert([
            'name' => 'presentation',
            'label' => 'Presentacion',
        ]);
        DB::table('permissions')->insert([
            'name' => 'presentation.create',
            'label' => 'Crear Presentacion',
        ]);
        DB::table('permissions')->insert([
            'name' => 'presentation.update',
            'label' => 'Actualizar Presentacion',
        ]);
        DB::table('permissions')->insert([
            'name' => 'presentation.delete',
            'label' => 'Eliminar Presentacion',
        ]);
        DB::table('permissions')->insert([
            'name' => 'product',
            'label' => 'Producto',
        ]);
        DB::table('permissions')->insert([
            'name' => 'product.create',
            'label' => 'Crear Producto',
        ]);
        DB::table('permissions')->insert([
            'name' => 'product.update',
            'label' => 'Actualizar Producto',
        ]);
        DB::table('permissions')->insert([
            'name' => 'product.delete',
            'label' => 'Eliminar Producto',
        ]);
        DB::table('permissions')->insert([
            'name' => 'sale',
            'label' => 'Ventas',
        ]);
        DB::table('permissions')->insert([
            'name' => 'sale.create',
            'label' => 'Crear Ventas',
        ]);
        DB::table('permissions')->insert([
            'name' => 'sale.create',
            'label' => 'Crear Ventas',
        ]);
        DB::table('permissions')->insert([
            'name' => 'sale.delete',
            'label' => 'Eliminar Ventas',

        ]);
        DB::table('permissions')->insert([
            'name' => 'supplier',
            'label' => 'Proveedor',
        ]);
        DB::table('permissions')->insert([
            'name' => 'supplier.create',
            'label' => 'Crear Proveedor',
        ]);
        DB::table('permissions')->insert([
            'name' => 'supplier.update',
            'label' => 'Actualizar Proveedor',
        ]);
        DB::table('permissions')->insert([
            'name' => 'supplier.delete',
            'label' => 'Eliminar Proveedor',
        ]);
        DB::table('permissions')->insert([
            'name' => 'type',
            'label' => 'Tipo de Prod.',
        ]);
        DB::table('permissions')->insert([
            'name' => 'type.create',
            'label' => 'Crear Tipo de Prod.',
        ]);
        DB::table('permissions')->insert([
            'name' => 'type.update',
            'label' => 'Actualizar Tipo de Prod.',
        ]);
        DB::table('permissions')->insert([
            'name' => 'type.delete',
            'label' => 'Eliminar Tipo de Prod.',
        ]);
        DB::table('permissions')->insert([
            'name' => 'usage',
            'label' => 'Uso',
        ]);
        DB::table('permissions')->insert([
            'name' => 'usage.create',
            'label' => 'Crear Uso',
        ]);
        DB::table('permissions')->insert([
            'name' => 'usage.update',
            'label' => 'Actualizar Uso',
        ]);
        DB::table('permissions')->insert([
            'name' => 'usage.delete',
            'label' => 'Eliminar Uso'
        ]);
        DB::table('permissions')->insert([
            'name' => 'user',
            'label' => 'Usuario',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user.create',
            'label' => 'Crear Usuario',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user.update',
            'label' => 'Actualizar Usuario',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user.delete',
            'label' => 'Eliminar Usuario',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role',
            'label' => 'Roles',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role.create',
            'label' => 'Crear Roles',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role.update',
            'label' => 'Actualizar Roles',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role.delete',
            'label' => 'Eliminar Roles',
        ]);
    }
}
