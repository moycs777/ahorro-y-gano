<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'admin_id' => 1,
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'status' => 1,
            'level' => 1,
            'state' => 'Bolivar',
            'city' => 'Bolivar City',
            'address' => 'vista hermosa vereda 6 #31'

        ]);
        
        DB::table('users')->insert([
            'name' => 'Moises',
            'email' => 'moycs777@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Cesar',
            'email' => 'cesar@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        DB::table('admins')->insert([
            'name' => 'Moises',
            'admin_id' => 2,
            'email' => 'moycs777@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '1234',
            'status' => true,
            'level' => 1,
            'state' => 'estado',
            'city' => 'ciudad',
            'address' => 'direccion'
        ]);

        DB::table('clasifications')->insert([
            'name' => 'Tienda regular',
            'doubt_percentage' => 0.50,
            'min_points' => 100,
            'status' => true
        ]);

        DB::table('clasifications')->insert([
            'name' => 'Inmobiliaria',
            'doubt_percentage' => 0.50,
            'min_points' => 25,
            'status' => true
        ]);

        DB::table('stores')->insert([
            'auth_id' => 3,
            'name' => 'Romar',
            'admin_id' => 2,
            'nif_cif' => '100',
            'clasification_id' => 1,
            'address' => 'true',
            'billing_address' => 'true',
            'state' => '1',
            'city' => 'true',
            'location' => 'true',
            'zip' => 'true',
            'phone_1' => 'true',
            'phone_2' => 'true',
            'email' => 'romar@gmail.com',
            'contact' => 'true',
            'debt_level' => 1,
            'status' => true
        ]);

        DB::table('admins')->insert([
            'name' => 'Romar',
            'admin_id' => 2,
            'email' => 'romar@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '1234',
            'status' => true,
            'level' => 5,
            'state' => 'estado',
            'city' => 'ciudad',
            'address' => 'direccion'
        ]);

        DB::table('promotions')->insert([
            'store_id' => 1,
            'name' => 'Gaterias Recargables',
            'description' => "los gatos reload",
            'price_not_offert' => 10,
            'price_with_offert' => 9, 
            'picture' => '/images/36gato.jpg',
            'location' => 'any where',
            'expires'  => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'points' => 9,
            'type' => 1
        ]);

        DB::table('promotions')->insert([
            'store_id' => 1,
            'name' => 'Casa amoblada',
            'description' => "un lugar para vivir",
            'price_not_offert' => 100000,
            'price_with_offert' => 90000, 
            'picture' => '/images/casa.jpg',
            'location' => 'sevilla',
            'expires'  => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'points' => 20000,
            'type' => 1
        ]);

        DB::table('competitions')->insert([
            'name' => 'Cesar Goal',
            'goal' => 120,
            'reward' => 50,
            'active' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
