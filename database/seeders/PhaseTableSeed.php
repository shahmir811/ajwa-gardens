<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhaseTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phase1 = Phase::create([
            'name'      => '1',
            'active'    => true,
        ]);

        $phase1->save();        
        
        
        $phase2 = Phase::create([
            'name'      => '2',
            'active'    => false,
        ]);

        $phase2->save();                
    }
}
