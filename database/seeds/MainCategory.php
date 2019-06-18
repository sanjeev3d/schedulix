<?php

use Illuminate\Database\Seeder;

class MainCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_category')->insert([
            'name' => "Web & Marketing",
        ]);

        DB::table('main_category')->insert([
            'name' => "Finance & Legal",
        ]);

        DB::table('main_category')->insert([
            'name' => "Heathcare",
        ]);

        DB::table('main_category')->insert([
            'name' => "Beauty & Personal Care",
        ]);

        DB::table('main_category')->insert([
            'name' => "Fitness",
        ]);

        DB::table('main_category')->insert([
            'name' => "Sales",
        ]);

        DB::table('main_category')->insert([
            'name' => "Education  -  Classes & Tuition",
        ]);

        DB::table('main_category')->insert([
            'name' => "Construction & Home Services",
        ]);

        DB::table('main_category')->insert([
            'name' => "Real Estate",
        ]);

        DB::table('main_category')->insert([
            'name' => "Entertainment, Arts & Photography",
        ]);

        DB::table('main_category')->insert([
            'name' => "Travel & Leisure",
        ]);

        DB::table('main_category')->insert([
            'name' => "Coaching & Consulting",
        ]);

        DB::table('main_category')->insert([
            'name' => "Directories & Agencies",
        ]);

        DB::table('main_category')->insert([
            'name' => "Call Centers",
        ]);

        DB::table('main_category')->insert([
            'name' => "Car  sales & Servicing",
        ]);

        DB::table('main_category')->insert([
            'name' => "Others",
        ]);
    }
}
