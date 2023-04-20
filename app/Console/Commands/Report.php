<?php

namespace App\Console\Commands;

use App\Exports\ReportExport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Command
{
    protected $signature = 'report';

    protected $description = 'Generate report of all users created.';

    public function handle()
    {
        Excel::store(new ReportExport(), 'report.xlsx');

        return Command::SUCCESS;
    }
}
