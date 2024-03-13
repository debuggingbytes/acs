<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CraneType;

class CraneTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $types = [[
            'type' => "rough_terrain_cranes",
            'text' => "Rough Terrain Crane"
        ],
        [
            'type' => "all_terrain_cranes",
            'text' => "All Terrain Crane"
        ],
        [
            'type' => "crawler_lattice_boom_cranes",
            'text' => "Crawler Lattice Boom Cranes"
        ],
        [
            'type' => "truck_mounted_telescopic_cranes",
            'text' => "Truck Mounted Telescopic Cranes"
        ],
        [
            'type' => "carry_deck_cranes",
            'text' => "Carry Deck Cranes"
        ],
        [
            'type' => "boom_truck_cranes",
            'text' => "Boom Truck Cranes"
        ]];
        foreach($types as $type){
        CraneType::Create([
            'type' => $type['type'],
            'text' => $type['text']
        ]);
        }
    }
}
