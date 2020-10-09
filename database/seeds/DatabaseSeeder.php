<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(CategoriasSeed::class);
        $this->call(ExperienciaSeed::class);
        $this->call(UbicacionSeeder::class);
        $this->call(SalariosSeeder::class);
        $this->call(UsuariosSeed::class);
    }
}
