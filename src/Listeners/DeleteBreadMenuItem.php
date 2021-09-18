<?php

namespace PEAVEL\Pilot\Listeners;

use PEAVEL\Pilot\Events\BreadDeleted;
use PEAVEL\Pilot\Facades\Pilot;

class DeleteBreadMenuItem
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Delete a MenuItem for a given BREAD.
     *
     * @param BreadDeleted $bread
     *
     * @return void
     */
    public function handle(BreadDeleted $bread)
    {
        if (config('pilot.bread.add_menu_item')) {
            $menuItem = Pilot::model('MenuItem')->where('route', 'pilot.'.$bread->dataType->slug.'.index');

            if ($menuItem->exists()) {
                $menuItem->delete();
            }
        }
    }
}
