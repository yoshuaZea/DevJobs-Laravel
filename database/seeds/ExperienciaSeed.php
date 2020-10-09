<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienciaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('experiencias')->insert([
            'nombre' => '0 - 6 meses',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('experiencias')->insert([
            'nombre' => '6 meses - 1 año',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('experiencias')->insert([
            'nombre' => '1 - 3 años',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('experiencias')->insert([
            'nombre' => '3 - 5 años',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('experiencias')->insert([
            'nombre' => '5 - 7 años',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('experiencias')->insert([
            'nombre' => '7 - 10 años',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('experiencias')->insert([
            'nombre' => '10 - 12 años',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('experiencias')->insert([
            'nombre' => 'Mas de 12 años',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
