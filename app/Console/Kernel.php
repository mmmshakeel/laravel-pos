<?php

namespace App\Console;

use App\Notifications\ProductExpiry;
use App\ProductItemDetails;
use App\User;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            // get the products that will be expire in 2 months
            $date_two_months = Carbon::now()->addMonths(2);

            // get the products which expires in two months
            $product_items = ProductItemDetails::where('expiry_date', '<=', $date_two_months)->get();

            // get all the admins
            $admin_users = User::where('is_admin', 1)->get();

            foreach ($product_items as $item) {
                // check if already a notification sent dor this product batch
                if (DB::table('notifications')->where('type', 'App\Notifications\ProductExpiry')
                        ->where('data', 'like', '%"product_id":'.$item->product_id.'%')
                        ->where('data', 'like', '%"batch_number":"'.$item->product_batch->batch_number.'"%')->count() == 0) {
                    Notification::send($admin_users, new ProductExpiry($item));
                }
            }

        })->daily();
    }
}
