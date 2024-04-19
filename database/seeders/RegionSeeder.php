<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;
use File;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        $json = File::get("database/data/regions.json");
        $regions = json_decode($json);
  
        foreach ($regions as $key => $value) {
            Region::create([
                "id" => $value->id,
                "name" => $value->name
            ]);
        }
    }
}
