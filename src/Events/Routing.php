<?php

namespace PEAVEL\Pilot\Events;

use Illuminate\Queue\SerializesModels;

class Routing
{
    use SerializesModels;

    public $router;

    public function __construct()
    {
        $this->router = app('router');

        // @deprecate
        //
        event('pilot.routing', $this->router);
    }
}
