<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Manager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        echo "RUNNING...\n";
        DB::table('accounts')->truncate();
        DB::table('managers')->truncate();

        Account::factory()->count(1)->for(
            Manager::factory(), 'accountable'
        )->create();
        echo "FINISH!\n";

        Schema::enableForeignKeyConstraints();
    }
}
