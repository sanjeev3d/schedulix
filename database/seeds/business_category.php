<?php

use Illuminate\Database\Seeder;

class business_category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('business_category')->insert([
            'name' => "Individual",
            'slug' => "individual ",
            'commnet'=>"If you are a solo flyer",
            
            
        ]);
        DB::table('business_category')->insert([
            'name' => "Business",
            'slug' => "business ",
            'commnet'=>"If you have multiple stores/ centres",
            
            
        ]);
    }
}
