<?php

namespace PEAVEL\Pilot\Actions;

class ViewAction extends AbstractAction
{
    public function getTitle()
    {
        return __('pilot::generic.view');
    }

    public function getIcon()
    {
        return 'pilot-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-warning pull-right view',
        ];
    }

    public function getDefaultRoute()
    {
        return route('pilot.'.$this->dataType->slug.'.show', $this->data->{$this->data->getKeyName()});
    }
}
