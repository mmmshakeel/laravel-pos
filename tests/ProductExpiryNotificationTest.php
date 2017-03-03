<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductExpiry;

class ProductExpiryNotificationTest extends TestCase
{

	use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductExpiryNotification()
    {
        // get all the admins
        $admin_users = App\User::where('is_admin', 1)->get();
        
        $user = App\User::first();

//        Notification::send($admin_users, new ProductExpiry);
        
        $user->notify(new ProductExpiry);
    }
}
