<?php

namespace App\Jobs;

use App\Events\ReportGenerated;
use App\Exports\ReportExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class GenerateReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $startdate,
        public string $enddate,
    )
    {
        //
    }

    public function handle(): void
    {
        $fileName = "report-{$this->startdate}-at-{$this->enddate}.xlsx";

        Excel::store(new ReportExport($this->startdate, $this->enddate), $fileName);

        event(new ReportGenerated($fileName));
    }
}
