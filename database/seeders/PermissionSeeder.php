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
        ]);
        DB::table('permissions')->insert([
            'name' => 'customer.create',
        ]);
        DB::table('permissions')->insert([
        'name' => 'customer.update',
        ]);
        DB::table('permissions')->insert([
        'name' => 'customer.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'laboratory',
        ]);
        DB::table('permissions')->insert([
            'name' => 'laboratory.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'laboratory.update',
        ]);
        DB::table('permissions')->insert([
            'name' => 'laboratory.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'location',
        ]);
        DB::table('permissions')->insert([
            'name' => 'location.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'location.update',
        ]);
        DB::table('permissions')->insert([
            'name' => 'location.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'order',
        ]);
        DB::table('permissions')->insert([
            'name' => 'order.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'order.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'presentation',
        ]);
        DB::table('permissions')->insert([
            'name' => 'presentation.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'presentation.update',
        ]);
        DB::table('permissions')->insert([
            'name' => 'presentation.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'product',
        ]);
        DB::table('permissions')->insert([
            'name' => 'product.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'product.update',
        ]);
        DB::table('permissions')->insert([
            'name' => 'product.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'sale',
        ]);
        DB::table('permissions')->insert([
            'name' => 'sale.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'sale.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'supplier',
        ]);
        DB::table('permissions')->insert([
            'name' => 'supplier.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'supplier.update',
        ]);
        DB::table('permissions')->insert([
            'name' => 'supplier.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'type',
        ]);
        DB::table('permissions')->insert([
            'name' => 'type.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'type.update',
        ]);
        DB::table('permissions')->insert([
            'name' => 'type.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'usage',
        ]);
        DB::table('permissions')->insert([
            'name' => 'usage.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'usage.update',
        ]);
        DB::table('permissions')->insert([
            'name' => 'usage.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user.update',
        ]);
        DB::table('permissions')->insert([
            'name' => 'user.delete',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role.create',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role.update',
        ]);
        DB::table('permissions')->insert([
            'name' => 'role.delete',
        ]);
    }
}
