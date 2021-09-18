<?php

namespace PEAVEL\Pilot\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PEAVEL\Pilot\Facades\Pilot;

class PageDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Pilot::model('Page')->count();
        $string = trans_choice('pilot::dimmer.page', $count);

        return view('pilot::dimmer', array_merge($this->config, [
            'icon'   => 'pilot-file-text',
            'title'  => "{$count} {$string}",
            'text'   => __('pilot::dimmer.page_text', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => __('pilot::dimmer.page_link_text'),
                'link' => route('pilot.pages.index'),
            ],
            'image' => pilot_asset('images/widget-backgrounds/03.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Pilot::model('Page'));
    }
}
