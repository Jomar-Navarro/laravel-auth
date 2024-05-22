<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use App\Functions\Helper as Help;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['HTML', 'CSS', 'Javascript', 'PHP', 'Laravel'];
        foreach($data as $item){
            $new_item = new Technology();
            $new_item->name = $item;
            $new_item->slug = Help::generateSlug($item, Technology::class);

            $new_item->save();
        }
    }
}
