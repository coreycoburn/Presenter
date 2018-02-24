<?php

namespace Coburncodes\Presenter\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class PresenterGenerator
{
    protected $folder = 'Presenters';
    protected $class;
    protected $method;

    public function __construct($class, $method)
    {
        $this->class = $class;
        $this->method = $method;
    }

    /**
     * Create the presenters directory if needed and save
     * the new presenter file.
     */
    public function make()
    {
        if (Config::has('presenters.folder')) {
            $this->folder = config('presenters.folder');
        }

        $directory = app_path() . '/' . $this->folder;
        $path = $directory . '/' . $this->class . '.php';

        if (!is_dir($directory)) {
            File::makeDirectory($directory);
        }

        File::put($path, $this->template());
    }

    /**
     * Retreive the template from the stub file and replace the
     * dynamic content to generate the correct markup.
     *
     * @return string
     */
    private function template()
    {
        $template = File::get(__DIR__ . '/Templates/presenter.stub');
        $namespace = app()->getNamespace() . $this->folder;

        return str_replace(
            ['{{NAMESPACE}}', '{{CLASS}}', '{{METHOD}}'],
            [$namespace, $this->class, $this->method],
            $template
        );
    }
}
