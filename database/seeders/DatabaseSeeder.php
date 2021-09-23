<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Developer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Developer::create([
            'name' => 'Mario Campbell',
            'profession' => 'Diseñador Gráfico',
            'position' => 'Frontend',
            'technology' => 'React'
        ]);
        Developer::create([
            'name' => 'Nicolás Berdú',
            'profession' => 'Ingeniero en sistemas',
            'position' => 'Backend',
            'technology' => 'laravel'
        ]);
        Developer::create([
            'name' => 'Carlos Soria',
            'profession' => 'Ingeniero en sistemas',
            'position' => 'Fullstack',
            'technology' => 'Nodejs'
        ]);
        Developer::factory(40)->create();
    }
}
