<?php

namespace Springly\Presenters;

class UserPresenter extends Presenter
{
    public function fullName()
    {
        return $this->entity->first_name . ' ' . $this->entity->last_name;
    }
}
