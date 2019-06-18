<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\CustomerModel;
use App\Models\AppointmentModel;
use Auth;
use Carbon\Carbon;
class SignupEmail extends Notification
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
        
        $filename = "invite.ics";
        $meeting_duration = (3600 * 2); // 2 hours
        $meetingstamp = strtotime( $this->customers->created_at . " UTC");
        $dtstart = gmdate('Ymd\THis\Z', $meetingstamp);
        $dtend =  gmdate('Ymd\THis\Z', $meetingstamp + $meeting_duration);
        $todaystamp = gmdate('Ymd\THis\Z');
        $uid = date('Ymd').'T'.date('His').'-'.rand().'@yourdomain.com';
        $description = strip_tags($this->customers->description);
        $location = "ABC ASSOTECH NOIDA SECTOR 135";
        $titulo_invite = "Appointment Schedule Sucessfully !!";
        $organizer = "CN=Organizer name:email@YourOrganizer.com";



        // ICS
        $mail[0]  = "BEGIN:VCALENDAR";
        $mail[1] = "PRODID:-//Google Inc//Google Calendar 70.9054//EN";
        $mail[2] = "VERSION:2.0";
        $mail[3] = "CALSCALE:GREGORIAN";
        $mail[4] = "METHOD:REQUEST";
        $mail[5] = "BEGIN:VEVENT";
        $mail[6] = "DTSTART;TZID=America/Sao_Paulo:". $dtstart;
        $mail[7] = "DTEND;TZID=America/Sao_Paulo:" . $dtend;
        $mail[8] = "DTSTAMP;TZID=America/Sao_Paulo:" . $todaystamp;
        $mail[9] = "UID:" . $uid;
        $mail[10] = "ORGANIZER;" . $organizer;
        $mail[11] = "CREATED:" .Carbon::now();
        $mail[12] = "DESCRIPTION:" . $this->customers->description;
        $mail[13] = "LAST-MODIFIED:". $todaystamp;
        $mail[14] = "LOCATION:". $location;
        $mail[15] = "SEQUENCE:0";
        $mail[16] = "STATUS:CONFIRMED";
        $mail[17] = "SUMMARY:" . $titulo_invite;
        $mail[18] = "TRANSP:OPAQUE";
        $mail[19] = "END:VEVENT";
        $mail[20] = "END:VCALENDAR";
        
        $mail = implode("\r\n", $mail);
        return (new MailMessage)
            ->line('Welcome'.' '.$this->customers->name.' '.$this->customers->last_name.'')
            // ->action('Click here to change your password and register.',url('/register?detail='.base64_encode($this->customers->name.' '.$this->customers->last_name.'#'.$this->customers->email.'#'.$this->customers->remember_token)))
            ->line('Your Appointment Schedule Sucessfully !!')
            ->attachData($mail, $filename, [
                'mime' => 'application/ics',
            ]);
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
             
        ];
    }
}
