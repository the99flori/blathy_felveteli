<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Panel;
use App\Models\User;

class PanelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('panel_user')->insert([
            'panel_id' => (Panel::where('room', "142")->first())->id,
            'user_id' => (User::where('email', "harangozo.zsolt@blathy.info")->first())->id,
        ]);
    }
}
