<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicacions')->insert([
            'nombre' => 'Remoto',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('ubicacions')->insert([
            'nombre' => 'Estados Unidos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('ubicacions')->insert([
            'nombre' => 'Canada',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('ubicacions')->insert([
            'nombre' => 'Colombia',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('ubicacions')->insert([
            'nombre' => 'México',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('ubicacions')->insert([
            'nombre' => 'Brazil',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
