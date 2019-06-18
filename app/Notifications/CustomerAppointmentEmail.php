<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\CustomerModel;
use App\Models\AppointmentModel;
use App\Models\ServiceAppointmentModel;
use Auth;
use Carbon\Carbon;
class CustomerAppointmentEmail extends Notification
{
    use Queueable;
protected $customers;
protected $appointment;



    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customers,$appointment,$bus)
    {
        $this->customers = $customers;
        $this->appointment = $appointment;
        $this->business = $bus;

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
        //dd($this->appointment);
        $filename = "invite.ics";
        $meeting_duration = (3600 * 0.5); // 2 hours
        $meetingstamp = strtotime( $this->appointment->appointment_time . " UTC");
        $dtstart = gmdate('Ymd\THis\Z', $meetingstamp);
        $dtend =  gmdate('Ymd\THis\Z', $meetingstamp + $meeting_duration);
        $todaystamp = gmdate('Ymd\THis\Z');
        $uid = date('Ymd').'T'.date('His').'-'.rand().'@Schdulix.com';
        $services = ServiceAppointmentModel::where('appointment_id',$this->appointment->id)->select('services_id','staff_id')->get();
        $service = array();
        $staff = array();
        foreach ($services as $key => $value) {
            if(!empty($value->serviceMenu->name)){
                array_push($service, $value->serviceMenu->name);
            }
        }
       
        foreach ($services as $key => $value) {
            if(!empty($value->getStaff->name)){
                array_push($staff, $value->getStaff->name);
            }
        }
        $instruction  = '';
        if(!empty($this->appointment->description)){
                $instruction = '\n Instruction:'.$this->appointment->description;
        }
        $allServices = implode(",", $service);
        $allStaff = implode(",", $staff);
        $bus_name = '';
        $bus_address = '';
        $bus_country ='';
        $bus_city ='';
        if(!empty($this->customers->getBusiness)){
           $bus_name =$this->customers->getBusiness->name;
           $bus_address =$this->customers->getBusiness->address; 
           $bus_country =$this->customers->getBusiness->country;
           $bus_city = $this->customers->getBusiness->city;
        }
       $abc =' Business: '.$bus_name.',\n Name: '.$this->customers->name.' '.$this->customers->last_name.',\n Email :'.$this->customers->email.',\n Address: '. $bus_address.',
       \n City:'. $bus_city.',\n Country:'.$bus_country.',\n Phone: '.$this->customers->mobile_phone.',\n Services:'.$allServices.',\n Staff:'.$allStaff.', '. $instruction; 

        
        $description = $abc;
        $location =  $bus_address.''.$bus_city.''.$bus_country;
        $titulo_invite = "New Appointment Schedule ";
        $organizer = "Schdulix";

        // ICS
        $mail[0] = "BEGIN:VCALENDAR";
        $mail[1] = "PRODID:-//Google Inc//Google Calendar 70.9054//EN";
        $mail[2] = "VERSION:2.0";
        $mail[3] = "CALSCALE:GREGORIAN";
        $mail[4] = "METHOD:REQUEST";
        $mail[5] = "BEGIN:VEVENT";
        $mail[6] = "DTSTART;TZID=America/Sao_Paulo:". $dtstart;
        $mail[7] = "DTEND;TZID=America/Sao_Paulo:" . $dtend;
        $mail[8] = "DTSTAMP;TZID=America/Sao_Paulo:" . $todaystamp;
        $mail[9] = "ORGANIZER;" . $organizer;
        $mail[11] = "CUTYPE=INDIVIDUAL:";
        $mail[12] = "ROLE=REQ-PARTICIPANT:";
        $mail[13] = "PARTSTAT=ACCEPTED:";
        $mail[14] = "RSVP=TRUE:";
        $mail[15] = "CREATED:" .Carbon::now();
        $mail[16] = "DESCRIPTION:" . $description;
        $mail[17] = "LAST-MODIFIED:". $todaystamp;
        $mail[18] = "LOCATION:". $location;
        $mail[19] = "SEQUENCE:0";
        $mail[20] = "STATUS:CONFIRMED";
        $mail[21] = "SUMMARY:" .$titulo_invite;
        $mail[22] = "TRANSP:OPAQUE";
        $mail[23] = "END:VEVENT";
        $mail[24] = "END:VCALENDAR";
        
        
        $mail = implode("\r\n", $mail);

        if(!empty(Auth::user()->email)){
            $email = Auth::user()->email;
        }else{
            $email = $this->business->email;
        }
        $sendAppointment = new MailMessage;
          $staff = '';
            if(!empty($allStaff)){

                   $staff = ' with Staff Name:'.$allStaff;
            }
        if(!empty(Auth::user()->role_id)) {
            
            $sendAppointment->line('Your Appointment Schedule Sucessfully !!.');
            $sendAppointment->line('This email confirms your Service Name : "'.$allServices.'".');
            $sendAppointment->line(' Appointment On Date: '.Carbon::parse($dtstart)->format('m-d-Y g:i A'). $staff.' at Location: '.$bus_address.'.');
            $sendAppointment->line('If you have any additional questions, use the contact details below to get in touch with us.');
            $sendAppointment->line('To cancel or reschedule your appointment before the scheduled time.');
            $sendAppointment->action('Click Here',url('/appointment/'.base64_encode($this->appointment->id)));
            $sendAppointment->line('Thanks for booking with Business Name: '. $bus_name);
            if(!empty($this->appointment->description)){
                $sendAppointment->line('Instruction: '.$this->appointment->description);
            }
            $sendAppointment->line('Business Address: '.$bus_address);
            // $sendAppointment->line('Location Address Line 1');
            // $sendAppointment->line('Location Address Line 2');
            $sendAppointment->line('Business City: '.$bus_city);
            $sendAppointment->line('Country: '.$bus_country);
           // $sendAppointment->line('Zip_code: '.$this->customers->getBusiness->zip_code);
            // $sendAppointment->line('Location Direction');
           // $sendAppointment->line('Staff Signature section');
            $sendAppointment->attachData($mail, $filename, [
                'mime' => 'application/ics',
            ]);

        }else { // for api user

           $sendAppointment->line('Your Appointment Schedule Sucessfully !!.');
            $sendAppointment->line('This email confirms your Service Name : "'.$allServices.'"');
            $sendAppointment->line(' Appointment On Date:'.Carbon::parse($dtstart)->format('m-d-Y g:i A'). $staff.' at Location: '.$this->customers->getBusiness->address);
            $sendAppointment->line('If you have any additional questions, use the contact details below to get in touch with us.');
            $sendAppointment->line('To cancel or reschedule your appointment before the scheduled time.');
            $sendAppointment->action('Click Here',url('/appointment/'.base64_encode($this->appointment->id)));
            $sendAppointment->line('Thanks for booking with Business Name: '. $bus_name);
            if(!empty($this->appointment->description)){
                $sendAppointment->line('Instruction: '.$this->appointment->description);
            }
            $sendAppointment->line('Business Address: '.$bus_address);
            // $sendAppointment->line('Location Address Line 1');
            // $sendAppointment->line('Location Address Line 2');
            $sendAppointment->line('Business City: '.$bus_city);
            $sendAppointment->line('Country: '.$bus_country);
            //$sendAppointment->line('Zip_code: '.$this->customers->getBusiness->zip_code);

           // $sendAppointment->line('Staff Signature section');
            $sendAppointment->attachData($mail, $filename, [
                'mime' => 'application/ics',
            ]);

        }
            return ($sendAppointment);
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
