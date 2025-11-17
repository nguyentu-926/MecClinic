<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;

class AppointmentReminderNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database']; // Lưu vào DB để hiển thị trên web
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Nhắc lịch khám với bác sĩ ' . $this->appointment->doctor->user->name,
            'appointment_date' => $this->appointment->appointment_date,
            'appointment_time' => $this->appointment->appointment_time,
            'doctor_name' => $this->appointment->doctor->user->name,
        ];
    }
}
