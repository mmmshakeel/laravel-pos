<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // dd(Auth::user()->notifications);

        // get all the notification for the logged in user
        return view('notification.notification', ['notifications2' => Auth::user()->notifications]);

    }

    public function routeToProduct($product_id, $notification_id)
    {
        // mark the notification read
        try {
            DB::table('notifications')->where('id', $notification_id)->update(['read_at' => Carbon::now()]);
        } catch (Exception $e) {
            Log::error($e);
        }

        // redirect to the product view page
        return redirect()->action('ProductController@show', ['id' => $product_id]);
    }
}
