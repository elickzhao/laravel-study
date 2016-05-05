<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Role::class,10)->create();

//        $f = Faker\Factory::create();
//        DB::table('roles')->insert([
//            'name'=> $f->name,
//        ]);

    }
}
