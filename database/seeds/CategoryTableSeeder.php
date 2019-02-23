<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert(
            array(
                ['name'=>'อาหารหวาน'],
                ['name'=>'อาหารคาว'],
                ['name'=>'ของทานเล่น'],
            )
        );
    }
}
