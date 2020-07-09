<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("tags")->insert([
                ["tag_name" => "HTML"],
                ["tag_name" => "CSS"],
                ["tag_name" => "JS"],
                ["tag_name" => "PHP"],
                ["tag_name" => "RUBY ON RAILS"],
                ["tag_name" => "GO"],
            ]
        );
    }
}
