<?php

namespace Illuminate\Notifications;

use Illuminate\Notifications\Console\NotificationMakeCommand;
use Illuminate\Notifications\Console\NotificationTableCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Notifications\Factory as FactoryContract;
use Illuminate\Contracts\Notifications\Dispatcher as DispatcherContract;
use Illuminate\Bus\Dispatcher as Bus;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Boot the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'notifications');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/resources/views' => $this->app->basePath().'/resources/views/vendor/notifications',
            ], 'laravel-notifications');
        }

        if (version_compare($this->getAppVersion(), '5.2', '<')) {
            $this->app->make(Bus::class)->maps([
                SendQueuedNotifications::class => SendQueuedNotificationsHandler::class . '@handle',
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();

        $this->app->singleton(ChannelManager::class, function ($app) {
            return new ChannelManager($app);
        });

        $this->app->alias(
            ChannelManager::class, DispatcherContract::class
        );

        $this->app->alias(
            ChannelManager::class, FactoryContract::class
        );
    }

    protected function registerCommands()
    {
        $this->app->singleton('command.notification.make', function ($app) {
            return new NotificationMakeCommand($app['files']);
        });

        $this->app->singleton('command.notification.table', function ($app) {
            return new NotificationTableCommand($app['files'], $app['composer']);
        });

        $this->commands([
            'command.notification.make',
            'command.notification.table'
        ]);
    }

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    private function getAppVersion()
    {
        $version = $this->app->version();
        if (substr($version, 0, 7) === 'Lumen (') {
            $version = array_first(explode(')', str_replace('Lumen (', '', $version)));
        }
        return $version;
    }
}
