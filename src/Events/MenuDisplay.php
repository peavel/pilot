<?php

namespace PEAVEL\Pilot\Events;

use Illuminate\Queue\SerializesModels;
use PEAVEL\Pilot\Models\Menu;

class MenuDisplay
{
    use SerializesModels;

    public $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;

        // @deprecate
        //
        event('pilot.menu.display', $menu);
    }
}
