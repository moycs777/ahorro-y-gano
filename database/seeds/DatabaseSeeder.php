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
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            'address' => 'vista hermosa vereda 6 #31'

        ]);
        
        //para q el id comience en 1000
        $startId = 1000;
        DB::table('users')->insert(['id'=> $startId - 1,
            'name' => 'poiu',
            'email' => 'poiu@gmail.com',
            'password' => bcrypt('12345678'),
            'reffer_id' => 0,]);
        DB::table('users')->where('id',$startId - 1)->delete();

        // para que los cupones empiecen en 25230
        $startId = 25230;
        DB::table('coupons')->insert(['id'=> $startId - 1,
            'store_id' => 0,
            'promotion_id' => 0,
            'user_id' => 0,
            'consolidated' => 0,
            'points' => 0,
            'payed' => 0,]);
        DB::table('coupons')->where('id',$startId - 1)->delete();

        DB::table('coupons')->insert([
            'store_id' => 0,
            'promotion_id' => 0,
            'user_id' => 0,
            'consolidated' => 0,
            'points' => 0,
            'payed' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'Moises',
            'email' => 'moycs777@gmail.com',
            'password' => bcrypt('12345678'),
            'reffer_id' => 1000,
            'confirmed' => 1,
        ]);

        DB::table('reffers')->insert([
            'user_id' => 1000,
            'reffered_id' => 1001,
        ]); 

        /*DB::table('reffers')->insert([
            'user_id' => 1,
            'reffered_id' => 3,
        ]);  */     
        
        DB::table('users')->insert([
            'name' => 'Cesar',
            'email' => 'cesar@gmail.com',
            'password' => bcrypt('12345678'),
            'reffer_id' => 1000,
            'confirmed' => 1,
        ]);

         DB::table('users')->insert([
            'name' => 'usuario 1 ref 1001',
            'email' => 'usuarioreferido1001@gmail.com',
            'password' => bcrypt('12345678'),
            'reffer_id' => 1001,
            'confirmed' => 1,
        ]);

         DB::table('reffers')->insert([
             'user_id' => 1001,
             'reffered_id' => 1002,
         ]);


         DB::table('users')->insert([
            'name' => 'usuario 2 ref 1001',
            'email' => 'usuario2referido1001@gmail.com',
            'password' => bcrypt('12345678'),
            'reffer_id' => 1001,
            'confirmed' => 1,
        ]);

         DB::table('reffers')->insert([
             'user_id' => 1001,
             'reffered_id' => 1003,
         ]);

         DB::table('users')->insert([
            'name' => 'usuario  ref 1002',
            'email' => 'usuario3referido1003@gmail.com',
            'password' => bcrypt('12345678'),
            'reffer_id' => 1002,
            'confirmed' => 1,
        ]);

         DB::table('reffers')->insert([
             'user_id' => 1002,
             'reffered_id' => 1004,
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
            'created_at'  => Carbon::now()->format('Y-m-d H:i:s'),
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
            'state' => 8,
            'city' => 8,
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

        DB::table('policies')->insert([
            'use' => 'politicas',
            'body' => 'nuestras politicas',
            
        ]);

        DB::table('competitions')->insert([
            'name' => 'Cesar Goal',
            'goal' => 120,
            'reward' => 50,
            'total' => 0.6,
            'active' => 1,
            'ended' => 0,
            'dead_line' => Carbon::create(2017, 10, 15)->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
