<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class CategoriasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('categorias')->insert([
            'nombre' => 'Front end',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Back end',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'DevOps',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'DBA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'UX/UI',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Techlead',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Full stack',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
