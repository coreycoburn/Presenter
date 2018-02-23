<?php

namespace Coburncodes\Presenter;

use Illuminate\Support\Facades\Config;
use Coburncodes\Presenter\Exceptions\PresenterException;

/**
 * Trait to be included into the model
 */
trait Presentable
{
    protected $presenter;
    protected $presenterInstance;

    /**
     * Determine if a config has been set for presenter namespace. If the app namespace has been
     * changed from "App" to something else and / or the presenters folder is somewhere located
     * in another directory besides "Presenters"
     *
     * Also, ensure that your presenter name is in the convention of ModelPresenter. i.e. UserPresenter.
     *
     * @return presenter instance
     */
    public function present()
    {
        $this->presenter = (Config::has('presenters.namespace')) ?
            config('presenters.namespace') . '\\' . class_basename($this) . 'Presenter' :
            'App\Presenters\\' . class_basename($this) . 'Presenter';

        if (!class_exists($this->presenter)) {
            throw new PresenterException('Invalid Presenter class. Use convention i.e. UserPresenter. Yours was: ' . $this->presenter);
        }

        if (!isset($this->presenterInstance)) {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }
}
