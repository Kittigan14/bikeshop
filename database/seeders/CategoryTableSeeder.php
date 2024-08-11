<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('category')->insert(
            array(
                ['name' => 'อะไหล่'],
                ['name' => 'เครื่องแต่งกาย'],
                ['name' => 'รองเท้า'],
                ['name' => 'แว่นตา'],
                ['name' => 'อุปกรณ์เสริม'],
                ['name' => 'อิเล็กทรอนิกส์'],
            )
        );
    }
}
