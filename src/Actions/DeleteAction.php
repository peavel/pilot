<?php

namespace PEAVEL\Pilot\Actions;

class DeleteAction extends AbstractAction
{
    public function getTitle()
    {
        return __('pilot::generic.delete');
    }

    public function getIcon()
    {
        return 'pilot-trash';
    }

    public function getPolicy()
    {
        return 'delete';
    }

    public function getAttributes()
    {
        return [
            'class'   => 'btn btn-sm btn-danger pull-right delete',
            'data-id' => $this->data->{$this->data->getKeyName()},
            'id'      => 'delete-'.$this->data->{$this->data->getKeyName()},
        ];
    }

    public function getDefaultRoute()
    {
        return 'javascript:;';
    }
}
