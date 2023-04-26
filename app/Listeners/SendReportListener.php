<?php

namespace App\Listeners;

use App\Mail\ReportEmail;
use Illuminate\Support\Facades\Mail;

class SendReportListener
{
    public function __construct()
    {
        //
    }

    public function handle(object $event): void
    {
        Mail::to("user@email.com")
            ->send(new ReportEmail($event->fileName));
    }
}
