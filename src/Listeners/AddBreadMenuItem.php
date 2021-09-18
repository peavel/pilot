<?php

namespace PEAVEL\Pilot\Listeners;

use PEAVEL\Pilot\Events\BreadAdded;
use PEAVEL\Pilot\Facades\Pilot;

class AddBreadMenuItem
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
     * Create a MenuItem for a given BREAD.
     *
     * @param BreadAdded $event
     *
     * @return void
     */
    public function handle(BreadAdded $bread)
    {
        if (config('pilot.bread.add_menu_item') && file_exists(base_path('routes/web.php'))) {
            $menu = Pilot::model('Menu')->where('name', config('pilot.bread.default_menu'))->firstOrFail();

            $menuItem = Pilot::model('MenuItem')->firstOrNew([
                'menu_id' => $menu->id,
                'title'   => $bread->dataType->getTranslatedAttribute('display_name_plural'),
                'url'     => '',
                'route'   => 'pilot.'.$bread->dataType->slug.'.index',
            ]);

            $order = Pilot::model('MenuItem')->highestOrderMenuItem();

            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => $bread->dataType->icon,
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => $order,
                ])->save();
            }
        }
    }
}
