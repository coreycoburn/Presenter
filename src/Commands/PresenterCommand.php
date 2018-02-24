<?php

namespace Coburncodes\Presenter\Commands;

use Illuminate\Console\Command;

class PresenterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presenter:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a view presenter for your model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = $this->ask('What is your model name?');
        $methodName = $this->ask('What do you want to present?');

        $class = ucfirst($model) . 'Presenter';
        $method = camel_case($methodName);

        (new PresenterGenerator($class, $method))->make();

        $this->info('View presenter ' . $class . ' created with a ' . $method . ' method.');
    }
}
