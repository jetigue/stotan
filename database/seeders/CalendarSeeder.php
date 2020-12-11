<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ints')
            ->insert([
                ['i' => 0],
                ['i' => 1],
                ['i' => 2],
                ['i' => 3],
                ['i' => 4],
                ['i' => 5],
                ['i' => 6],
                ['i' => 7],
                ['i' => 8],
                ['i' => 9]
            ]);

////        DB::insert('insert into calendar (calendar_date) select DATE('2020-01-01') + INTERVAL a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i DAY
////FROM ints a JOIN ints b JOIN ints c JOIN ints d JOIN ints e
////WHERE (a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i) <= 11322 DAY
////ORDER BY 1');
//
//        DB::table('calendar')
//            ->insert(['calendar_date' => date('2020-01-01')]);
//
//
////SELECT DATE('2020-01-01') + INTERVAL a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i DAY
////FROM ints a JOIN ints b JOIN ints c JOIN ints d JOIN ints e
////WHERE (a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i) <= 11322
////ORDER BY 1);
////    }
    }
}
