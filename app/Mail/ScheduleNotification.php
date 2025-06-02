<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $scheduleData;

    public function __construct($scheduleData)
    {
        $this->scheduleData = $scheduleData;
    }

    public function build()
    {
        return $this->subject('Có Đơn Đặt Lịch Mới')
                    ->view('emails.schedule_notification')
                    ->with('scheduleData', $this->scheduleData);
    }
}
