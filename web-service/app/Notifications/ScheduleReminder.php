<?php

namespace App\Notifications;

use App\Channels\WhatsappChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ScheduleReminder extends Notification
{
    use Queueable;


    /**
     * Create a new notification instance.
     */
    public function __construct(public $schedule){

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WhatsappChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toWhatsapp(object $notifiable): string
    {
        $name = $notifiable->name;
        $date = $this->schedule->schedule_date->format('d/m/Y');
        $time = $this->schedule->schedule_date->format('H:i');
        $location = 'Cafe Nut Castle';
        return "Hai $name!\n\nKami dari Nut Castle ingin mengingatkan bahwa kamu memiliki jadwal konsultasi pada:\n\nTanggal: $date\nWaktu: $time WIB\nLokasi: $location\n\nPastikan kamu datang tepat waktu dan dalam kondisi siap ya. Konsultasi ini penting untuk memastikan program diet kamu tetap berjalan optimal.\n\nSampai jumpa di Nut Castle!";
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
