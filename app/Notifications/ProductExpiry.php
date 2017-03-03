<?php

namespace App\Notifications;

use App\ProductItemDetails;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProductExpiry extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // get the products that will be expire in 2 months

        $date_two_months = Carbon::now()->addMonths(2);

        // get the products which expires in two months
        $product_items = ProductItemDetails::where('expiry_date', '<=', $date_two_months)->get();

        return [
            'product_id'       => $product_items->product_id,
            'product_batch_id' => $product_items->product_batch_id,
            'expiry_date'      => $product_items->expiry_date,
            'inventory_count'  => $product_items->product->inventory->total_stock,
        ];
    }
}
