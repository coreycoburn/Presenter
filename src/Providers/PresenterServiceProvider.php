<?php

namespace Coburncodes\Presenter\Providers;

use Illuminate\Support\ServiceProvider;
use Coburncodes\Presenter\Commands\PresenterCommand;

class PresenterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCommands();
        $this->publishCommands();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(PresenterCommand::class);
        }
    }

    public function publishCommands()
    {
        $this->publishes([
            __DIR__ . '/../../config/presenters.php' => config_path('presenters.php'),
        ]);
    }
}
