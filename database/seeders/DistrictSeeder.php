<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\District;
use File;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  
        $json = File::get("database/data/districts.json");
        $districts = json_decode($json);
  
        foreach ($districts as $key => $value) {
            District::create([
                "id" => $value->id,
                "region_id" => $value->region_id,
                "name" => $value->name
            ]);
        }
    }
}
