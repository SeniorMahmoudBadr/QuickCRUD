<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notifications extends Notification
{
    use Queueable;

    protected $data;
    protected $type;
    protected $msg;
    /**
     * Create a new notification instance.
     */
    public function __construct($data,$type,$msg)
    {
        $this->data=$data;
        $this->type=$type;
        $this->msg=$msg;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return [
            //
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' =>$this->data?->id,
            'name' =>$this->data?->name,
            'type' =>$this->type,
            'msg' =>$this->msg,
            'created_by' =>auth()->id(),
        ];
    }
}
