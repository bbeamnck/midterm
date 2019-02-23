<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert(
            array(
                [
                    'code'=>'A001',
                    'name'=>'เค้กส้ม',
                    'category_id'=>1,
                    'price'=>65,
                    'stock_qty'=>5,
                ],
                [
                    'code'=>'A002',
                    'name'=>'พิซซ่า',
                    'category_id'=>2,
                    'price'=>299,
                    'stock_qty'=>10,
                ],
                [
                    'code'=>'A003',
                    'name'=>'ขนมเลย์',
                    'category_id'=>3,
                    'price'=>30,
                    'stock_qty'=>88,
                ],
            )
        );
    }
}
