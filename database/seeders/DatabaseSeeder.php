<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Section;
use App\Models\Invoices;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::factory(10)->create();
        Invoices::factory(10)->create();
        Product::factory(10)->create();
       


    }
}
