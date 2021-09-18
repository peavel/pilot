<?php

namespace PEAVEL\Pilot\Events;

use Illuminate\Queue\SerializesModels;
use PEAVEL\Pilot\Models\Setting;

class SettingUpdated
{
    use SerializesModels;

    public $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
}
