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
        DB::table('categories')->delete();
        $data = [
            ['title'=>'समाचार','slug'=>str_slug('samachar'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
            ['title'=>'दृष्टिकोण','slug'=>str_slug('perspective'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
            ['title'=>'प्रवास','slug'=>str_slug('foreign'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
            ['title'=>'साहित्य','slug'=>str_slug('literature'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
            ['title'=>'खेलकुद','slug'=>str_slug('sports'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
            
            ['title'=>'जीवन जगत','slug'=>str_slug('jiwan jagat'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
            
            
            ['title'=>'पर्यटन','slug'=>str_slug('tourisim'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
            ['title'=>'बजार','slug'=>str_slug('market'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
            
           
            ['title'=>'प्रविधि','slug'=>str_slug('technology'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
            ['title'=>'फिचर','slug'=>str_slug('feature'),'meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1'],
           

            
          ];
        \App\Models\Category::insert($data);
    }
}
