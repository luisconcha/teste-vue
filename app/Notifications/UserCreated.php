<?php

namespace LACC\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreated extends Notification
{
    /**
     * @var
     */
    private $token;

    /**
     * UserCreated constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $appName = config('APP_NAME');
        return (new MailMessage)
            ->subject("Your account was created on the {$appName} platform")
            ->greeting("Hi {$notifiable->name}, welcome ao {$appName}")
            ->line("Your registration number is {$notifiable->enrolment}")
            ->action("Click here to reset  your password", route('password.reset', $this->token))
            ->line('Thank you for using our application!')
            ->salutation("Best regards {$appName}");
    }

}
