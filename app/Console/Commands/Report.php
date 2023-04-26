<?php

namespace App\Console\Commands;

use App\Exports\ReportExport;
use App\Jobs\GenerateReport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Command
{
    protected $signature = 'report {startdate} {enddate}';

    protected $description = 'Generate report of all users created.';

    public function handle()
    {
        $startdate = $this->argument('startdate');
        $enddate = $this->argument('enddate');

        dispatch(new GenerateReport($startdate, $enddate));

        return Command::SUCCESS;
    }
}
