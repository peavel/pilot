<?php

namespace PEAVEL\Pilot\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PEAVEL\Pilot\Facades\Pilot;

class PostDimmer extends BaseDimmer
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
        $count = Pilot::model('Post')->count();
        $string = trans_choice('pilot::dimmer.post', $count);

        return view('pilot::dimmer', array_merge($this->config, [
            'icon'   => 'pilot-news',
            'title'  => "{$count} {$string}",
            'text'   => __('pilot::dimmer.post_text', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => __('pilot::dimmer.post_link_text'),
                'link' => route('pilot.posts.index'),
            ],
            'image' => pilot_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Pilot::model('Post'));
    }
}
