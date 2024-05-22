<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Projects;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use App\Functions\Helper as Help;


class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['xxx', 'xx', 'aa', 'aaaa', 'aaaaaa'];
        foreach($data as $item){
            $new_item = new Projects();
            $new_item->title = $item;
            $new_item->slug = Help::generateSlug($item, Projects::class);
            $new_item->description = $item;
            $new_item->project_url = $item;

            $new_item->save();
        }
    }
}
