<?php

namespace Modules\Travel\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use Modules\Travel\Entities\Travel;


class SubmitApplication extends Notification
{
    use Queueable;
    
    public $user;
    public $travel;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Travel $travel, User $user)
    {
        $this->travel = $travel;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You\'ve received an application to be reviewed by '. $this->user->name)   
                    ->line('Thank you.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'You\'ve received an application to be reviewed by '. $this->user->name,
            'travel_id' => $this->travel->id,
        ];
    }
}
