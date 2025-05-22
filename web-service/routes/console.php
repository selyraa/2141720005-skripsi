<?php

use App\Console\Commands\SendScheduleReminders;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(SendScheduleReminders::class)->dailyAt('08:00')->timezone('Asia/Jakarta')->runInBackground();
