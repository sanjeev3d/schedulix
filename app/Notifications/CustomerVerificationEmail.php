<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
use App\Models\CustomerModel;
class CustomerVerificationEmail extends Notification
{
    use Queueable;
     protected $customers;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->subject('Customer Registration Email')
            ->line('Welcome'.' '.$this->customers->name.' '.$this->customers->last_name.'')
            ->action('Click here to change your password and register.',url('/register?detail='.base64_encode($this->customers->name.' '.$this->customers->last_name.'#'.$this->customers->email.'#'.$this->customers->remember_token.'#'.$this->customers->id)))

            ->line('Thank you for using our application!');
        
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            // 'name' => $this->customers->name .''.$this->customers->last_name,
            // 'email'=>$this->customers->email,
            // 'remember_token'=>$this->customers->remember_token
        ];
    }
}
