<?php

use Illuminate\Database\Seeder;

class StudyMaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\StudyMaterial::class, 5)->create();
    }
}
