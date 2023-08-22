<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Cliente::factory()->times(15)->create();
        Pago::factory()->times(8)->create()->each(function($pago){
            $pago->clientes()->sync(
                Cliente::all()->random(3)
            );
        });
        //funcion para crear datos de prueba en la base de datos y se ejecuta con el comando php artisan db:seed

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
