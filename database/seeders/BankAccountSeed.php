<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BankAccountSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_accounts')->insert([
            [
                'bank_number' => 15,
                'branch_number' => 165,
                'account_number' => 58745,
                'user_id' => 1,
                'password' => Hash::make('12345678A'),
                'balance' => 10000,
                'account_type' => 'C',
                'opening_date' => '2020-10-12 10:35:48',
                'account_status' => 'A',
            ],
            [
                'bank_number' => 10,
                'branch_number' => 258,
                'account_number' => 65485,
                'user_id' => 2,
                'password' => Hash::make('12345678L'),
                'balance' => 5000,
                'account_type' => 'P',
                'opening_date' => '2019-11-08 12:28:31',
                'account_status' => 'A',
            ],
            [
                'bank_number' => 41,
                'branch_number' => 845,
                'account_number' => 75482,
                'user_id' => 3,
                'password' => Hash::make('12345678S'),
                'balance' => 100000,
                'account_type' => 'C',
                'opening_date' => '2018-07-10 18:02:20',
                'account_status' => 'A',
            ]
        ]);
    }
}
