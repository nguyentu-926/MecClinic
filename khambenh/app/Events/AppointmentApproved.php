<?php

namespace App\Events;

use App\Models\Appointment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class AppointmentApproved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function broadcastOn()
    {
        return new Channel('appointments'); // kênh chung
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->appointment->id,
            'status' => $this->appointment->status,
            'doctor_name' => $this->appointment->doctor->user->name ?? 'Không xác định'
        ];
    }
}
