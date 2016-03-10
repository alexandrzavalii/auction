<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Bids;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
          $bids = Bids::orderBy('id')->get();
          foreach ($bids as $bid) {
            if(strtotime($bid->expiration)-strtotime(\Carbon\Carbon::now())<0){
              if($bid->customerId){
                \Stripe\Stripe::setApiKey("sk_test_Z98H9hmuZWjFWfbkPFvrJMgk");
              \Stripe\Charge::create(array(
                "amount" => $bid->priceToCents(), // amount in cents, again
                "currency" => "usd",
                "customer" => $bid->customerId
                ));
                \Log::info('Charged: '. $bid->amount);
                }
              $bid->delete();
              \Log::info('Deleted  bid: '. $bid->id);
            }

          }

        })->everyMinute();

    }
}
