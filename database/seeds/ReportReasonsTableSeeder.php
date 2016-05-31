<?php

use App\ReportReason;
use Illuminate\Database\Seeder;

class ReportReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('report_reasons')->truncate();

        ReportReason::create(array(
            'reason' => 'Abusive',
            'description' => 'Abusive desc',
        ));

        ReportReason::create(array(
            'reason' => 'Sexually Explicit',
            'description' => 'Sexually Explicit desc',
        ));

        ReportReason::create(array(
            'reason' => 'Spammy',
            'description' => 'Spammy desc',
        ));

    }
}
