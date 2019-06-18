<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class EmailReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($allreminder)
    {
        $this->allreminder = $allreminder;
        // dd($allreminder);
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
            $sendMail = (new MailMessage);
            // foreach ($this->allreminder->serviceAppointment as $servicedetails) {
            $mysubject = 'Appointment Reminder on '.$this->allreminder->appointment_date. '&' .$this->allreminder->appointment_time;
            // }
            $sendMail->subject($mysubject);
            $sendMail->line($this->allreminder->businessName);
            $sendMail->line('Your appointment is coming up!');
            $sendMail->line('Hey Customer,');
            $myname ='';
            $myname = 'This is a friendly reminder that your ';
            
            foreach ($this->allreminder->serviceAppointment as $key => $servicedetails) {
                $myname .= $servicedetails->serviceMenu->name.' appointment with '.$servicedetails->getStaff->name;
                if(count($this->allreminder->serviceAppointment)-1 > $key){
                    $myname .= ' and ';
                }
            }
            $myname.= ' at Location Name is scheduled for Date Time Client Timezone.';
            $sendMail->line($myname);
            $sendMail->line('If you have questions before your appointment, use the contact details below to get in touch with us.');
            $sendMail->line('Thanks for scheduling with '.$this->allreminder->businessName.'!');

            return $sendMail;
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
