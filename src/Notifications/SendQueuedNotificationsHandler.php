<?php

namespace Illuminate\Notifications;

use Illuminate\Support\Facades\Notification as Manager;

class SendQueuedNotificationsHandler
{
    /**
     * Send the notifications.
     *
     * @param  \Illuminate\Notifications\SendQueuedNotifications $command
     * @return void
     */
    public function handle(SendQueuedNotifications $command)
    {
        Manager::sendNow($command->notifiables, $command->notification);
    }
}
