<?php

namespace PEAVEL\Pilot\Actions;

class EditAction extends AbstractAction
{
    public function getTitle()
    {
        return __('pilot::generic.edit');
    }

    public function getIcon()
    {
        return 'pilot-edit';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right edit',
        ];
    }

    public function getDefaultRoute()
    {
        return route('pilot.'.$this->dataType->slug.'.edit', $this->data->{$this->data->getKeyName()});
    }
}
