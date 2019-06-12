<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        factory(\App\Models\Product::class, 5)->make()
        ->each(function($product) use ($users){
            $product->user_id = $users->random()->id;
            $product->save();
        });
    }
}
