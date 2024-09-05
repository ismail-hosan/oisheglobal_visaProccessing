<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main_menu = array(
            (object) array(
                "name" => "About Us",
                "order_by" => 1,
                "route_name" => "menu.aboutus",
                "parent_id" => 0,
                "model" => "App\Models\AboutUs",
                "submenu" =>  (object) array(
                    (object) array("name" => "Our Team", 'order_by' => "", 'route_name' => "menu.aboutus.ourteam", 'model' => 'App\Models\OurTeam'),
                    (object) array("name" => "Our client", 'order_by' => "", 'route_name' => "menu.aboutus.ourclient", 'model' => 'App\Models\OurClient'),
                    (object) array("name" => "Testimunial", 'order_by' => "", 'route_name' => "menu.aboutus.testimunials", 'model' => 'App\Models\Testimonial'),
                ),
            )
        );

        foreach ($main_menu as $mainvalue) {
            $category = new Category();
            $category->name = $mainvalue->name;
            $category->order_by = $mainvalue->order_by;
            $category->route_name = $mainvalue->route_name;
            $category->parent_id = $mainvalue->parent_id;
            $category->model = $mainvalue->model;
            $category->slug = Str::slug($mainvalue->name);
            $category->save();
            $mainid = $category->id;

            foreach ($mainvalue->submenu as $submenu) {
                $category = new Category();
                $category->name = $submenu->name;
                $category->slug = Str::slug($submenu->name);
                $category->order_by = $submenu->order_by;
                $category->route_name = $submenu->route_name;
                $category->parent_id = $mainid;
                $category->model = $submenu->model;
                $category->save();
            }
        }
    }
}
