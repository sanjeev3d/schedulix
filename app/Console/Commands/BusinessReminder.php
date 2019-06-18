<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AppointmentModel;
use App\Notifications\EmailReminder;
use Carbon\Carbon;
use Log;

class BusinessReminder extends Command
{   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'business:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder email to business before 24 hours';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reminder = AppointmentModel::with('businessDetails','userBusinessDetails','serviceAppointment')->where('status','active')->get();
        foreach ($reminder as $allreminder)
        {
            $alldate = $allreminder->appointment_date;
            $alltime = $allreminder->appointment_time;
            $nowdate = strtotime(date('Y-m-d H:i:s'));
            $getDate =strtotime("$alldate $alltime") - 86400;
            $emaildate = date('Y-m-d H:i:s', $getDate);

                \Log::debug('An informational message.'.date('Y-m-d H:i:s'));
            // dd($nowdate, $getDate);
            if($nowdate > $getDate){
                $allreminder->email = $allreminder->userBusinessDetails->getUser->email;
                $allreminder->businessName = $allreminder->businessDetails->name;
                $allreminder->businessTime = $allreminder->businessDetails->name;
                $allreminder->notify(new EmailReminder($allreminder));

            }
        }
    }
}
