<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
use App\Models\CustomerModel;
use App\User;
class CustomerRegVerification extends Notification
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
        $userInfo =User::where('email',$this->customers->email)->first();
        $sendEmail = new MailMessage;
        if($userInfo->role_id == '2'){
            $sendEmail->subject('Business User Verification');
        } else{
             $sendEmail->subject('Customer User Verification');
        }
        $sendEmail->line('Welcome'.' '.$this->customers->name.' '.$this->customers->last_name.'');
        $sendEmail->action('Click here to verify  your account.',url('/verify-account?detail='.base64_encode( $userInfo->id)));
        $sendEmail->line('Thank you for using our application!');

        return $sendEmail;
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
            //
        ];
    }
}
