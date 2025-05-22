<?php

namespace App\Console\Commands;

use App\Models\ConsultationSchedule;
use App\Notifications\ScheduleReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendScheduleReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-schedule-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim notifikasi pengingat jadwal konsultasi kepada pengguna (besok)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow();
        $schedules = ConsultationSchedule::whereDate('schedule_date', $tomorrow)
            ->with(['programEnrollment.user'])
            ->get();
        foreach ($schedules as $schedule) {
            if ($schedule->programEnrollment->user->phone_number) {
                $schedule->programEnrollment->user->notify(new ScheduleReminder($schedule));
            }
        }

        $this->info('Notifikasi pengingat jadwal konsultasi telah dikirim.');
    }
}
