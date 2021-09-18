<?php

namespace PEAVEL\Pilot\Events;

use Illuminate\Queue\SerializesModels;

class RoutingAdmin
{
    use SerializesModels;

    public $router;

    public function __construct()
    {
        $this->router = app('router');

        // @deprecate
        //
        event('pilot.admin.routing', $this->router);
    }
}
