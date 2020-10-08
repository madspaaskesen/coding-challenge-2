<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entries')->insert([
            'start' => Carbon::createFromFormat('d/m/Y H:i:s', '08/09/2020 08:00:00'),
            'end' => Carbon::createFromFormat('d/m/Y H:i:s', '08/09/2020 09:00:00'),
            'project_id' => 1
        ]);

        DB::table('entries')->insert([
            'start' => Carbon::createFromFormat('d/m/Y H:i:s', '08/09/2020 10:00:00'),
            'end' => Carbon::createFromFormat('d/m/Y H:i:s', '08/09/2020 11:30:00'),
            'project_id' => 1
        ]);
    }
}
