<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        $business_category = DB::table('business_category')->get();
        if($business_category->isEmpty()){
            $this->call(business_category::class);
        }
        

        $user_role = DB::table('user_role')->get();
        if($user_role->isEmpty()){
            $this->call(UserRole::class);
        }

        $main_category = DB::table('main_category')->get();
        if($main_category->isEmpty()){
            $this->call(MainCategory::class);
        }

        $main_category_service = DB::table('main_category_service')->get();
        if($main_category_service->isEmpty()){
            $this->call(MainCategoryService::class);
        }

        $country = DB::table('country')->get();
        if($country->isEmpty()){
            $this->call(CountrySeeder::class);
        }

        $state = DB::table('state')->get();
        if($state->isEmpty()){
            $this->call(StateSeeder::class);
        }

        $city = DB::table('city')->get();
        if($city->isEmpty()){
            $this->call(CitySeeder::class);
        }

        // factory(App\User::class,5)->create();
    }
}