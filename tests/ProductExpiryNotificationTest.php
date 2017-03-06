<?php

use App\Notifications\ProductExpiry;
use App\ProductItemDetails;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;

class ProductExpiryNotificationTest extends TestCase
{

    // use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductExpiryNotification()
    {
        // get the products that will be expire in 2 months
        $date_two_months = Carbon::now()->addMonths(2);

        // get the products which expires in two months
        $product_items = ProductItemDetails::where('expiry_date', '<=', $date_two_months)->get();

        // get all the admins
        $admin_users = App\User::where('is_admin', 1)->get();

        foreach ($product_items as $item) {
            Notification::send($admin_users, new ProductExpiry($item));
        }
        
    }
}
