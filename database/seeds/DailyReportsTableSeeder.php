<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DailyReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_reports')->truncate();
        DB::table('daily_reports')->insert([
            [
                'user_id'           => 1,
                'title'             => 'test01',
                'content'           => 'test01',
                'reporting_time'    => Carbon::create(2019, 1, 1),
                'created_at'        => Carbon::create(2019, 1, 1),
            ],
            [
                'user_id'           => 2,
                'title'             => 'test03',
                'content'           => 'test03',
                'reporting_time'    => Carbon::create(2019, 1, 2),
                'created_at'        => Carbon::create(2019, 1, 2),
            ],
            [
                'user_id'           => 1,
                'title'             => 'test03',
                'content'           => 'test03',
                'reporting_time'    => Carbon::create(2019, 1, 3),
                'created_at'        => Carbon::create(2019, 1, 3),
            ]
        ]);
    }
}
