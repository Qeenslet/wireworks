<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert(array(
                                                array('name'=>'Браслеты', 'url'=>'bracelets', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
                                                array('name'=>'Сережки', 'url'=>'earrings', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
                                                array('name'=>'Кольца', 'url'=>'rings', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
                                                array('name'=>'Кулоны', 'url'=>'pendants', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
                                                array('name'=>'Разное', 'url'=>'misc', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
            ));
        DB::table('users')->truncate();
        DB::table('users')->insert(array('name'=>'admin',
                                        'email'=>'cspook@rambler.ru',
                                        'password'=>bcrypt('123456789'),
                                        'created_at'=>DB::raw('NOW()'),
                                        'updated_at'=>DB::raw('NOW()')));
    }

}
