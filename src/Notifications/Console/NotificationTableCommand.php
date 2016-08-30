<?php

namespace Illuminate\Notifications\Console;

use ReflectionClass;
use InvalidArgumentException;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class NotificationTableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'notifications:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a migration for the notifications table';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * @var mixed
     */
    protected $composer;

    /**
     * Create a new notifications table command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  mixed $composer
     * @return void
     */
    public function __construct(Filesystem $files, $composer)
    {
        parent::__construct();

        $this->files = $files;
        $composerClass = 'Illuminate\Support\Composer';
        if (class_exists('Illuminate\Foundation\Composer')) {
            $composerClass = 'Illuminate\Foundation\Composer';
        }
        $reflection = new ReflectionClass($composerClass);
        if (!is_object($composer) || !$reflection->isInstance($composer)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Argument 2 passed to %s::%s must be an instance of %s',
                    __CLASS__,
                    __FUNCTION__,
                    $composerClass
                )
            );
        }
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $fullPath = $this->createBaseMigration();

        $this->files->put($fullPath, $this->files->get(__DIR__.'/stubs/notifications.stub'));

        $this->info('Migration created successfully!');

        $this->composer->dumpAutoloads();
    }

    /**
     * Create a base migration file for the notifications.
     *
     * @return string
     */
    protected function createBaseMigration()
    {
        $name = 'create_notifications_table';

        $path = $this->laravel->databasePath().'/migrations';

        return $this->laravel['migration.creator']->create($name, $path);
    }
}
