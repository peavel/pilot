<?php

namespace PEAVEL\Pilot\Models;

use Illuminate\Database\Eloquent\Model;
use PEAVEL\Pilot\Events\SettingUpdated;

class Setting extends Model
{
    protected $table = 'settings';

    protected $guarded = [];

    public $timestamps = false;

    protected $dispatchesEvents = [
        'updating' => SettingUpdated::class,
    ];
}
