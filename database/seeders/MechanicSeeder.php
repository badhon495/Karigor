<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mechanic;

class MechanicSeeder extends Seeder
{
    public function run()
    {
        $names = ['Rashid', 'Karim', 'Jabbar', 'Akash', 'Tariq'];
        foreach ($names as $name) {
            Mechanic::create(['name' => $name]);
        }
    }
}
