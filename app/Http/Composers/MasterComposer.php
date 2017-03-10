<?php
namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class MasterComposer
{

    public function compose(View $view)
    {

        $notifications       = [];
        $notifications_count = 0;
        $loged_user_name     = '';

        // get the authenticated user
        if ($user = Auth::user()) {
            // get any notifications for the authenticated user
            $notifications       = $user->unreadNotifications;
            $notifications_count = count($notifications);
            $loged_user_name     = $user->staff->first_name . ' ' . $user->staff->last_name;
        }

        $view->with('loged_user_name', $loged_user_name)
            ->with('notifications', $notifications)
            ->with('notifications_count', $notifications_count);
    }

}
