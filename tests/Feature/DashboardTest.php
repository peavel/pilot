<?php

namespace PEAVEL\Pilot\Tests\Feature;

use Illuminate\Support\Facades\Auth;
use PEAVEL\Pilot\Facades\Pilot;
use PEAVEL\Pilot\Tests\TestCase;

class DashboardTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->install();
    }

    /**
     * Test Dashboard Widgets.
     *
     * This test will make sure the configured widgets are being shown on
     * the dashboard page.
     */
    public function testWidgetsAreBeingShownOnDashboardPage()
    {
        // We must first login and visit the dashboard page.
        Auth::loginUsingId(1);

        $this->visit(route('pilot.dashboard'))
            ->see(__('pilot::generic.dashboard'));

        // Test UserDimmer widget
        $this->see(trans_choice('pilot::dimmer.user', 1))
             ->click(__('pilot::dimmer.user_link_text'))
             ->seePageIs(route('pilot.users.index'))
             ->click(__('pilot::generic.dashboard'))
             ->seePageIs(route('pilot.dashboard'));

        // Test PostDimmer widget
        $this->see(trans_choice('pilot::dimmer.post', 4))
             ->click(__('pilot::dimmer.post_link_text'))
             ->seePageIs(route('pilot.posts.index'))
             ->click(__('pilot::generic.dashboard'))
             ->seePageIs(route('pilot.dashboard'));

        // Test PageDimmer widget
        $this->see(trans_choice('pilot::dimmer.page', 1))
             ->click(__('pilot::dimmer.page_link_text'))
             ->seePageIs(route('pilot.pages.index'))
             ->click(__('pilot::generic.dashboard'))
             ->seePageIs(route('pilot.dashboard'))
             ->see(__('pilot::generic.dashboard'));
    }

    /**
     * UserDimmer widget isn't displayed without the right permissions.
     */
    public function testUserDimmerWidgetIsNotShownWithoutTheRightPermissions()
    {
        // We must first login and visit the dashboard page.
        $user = \Auth::loginUsingId(1);

        // Remove `browse_users` permission
        $user->role->permissions()->detach(
            $user->role->permissions()->where('key', 'browse_users')->first()
        );

        $this->visit(route('pilot.dashboard'))
            ->see(__('pilot::generic.dashboard'));

        // Test UserDimmer widget
        $this->dontSee('<h4>1 '.trans_choice('pilot::dimmer.user', 1).'</h4>')
             ->dontSee(__('pilot::dimmer.user_link_text'));
    }

    /**
     * PostDimmer widget isn't displayed without the right permissions.
     */
    public function testPostDimmerWidgetIsNotShownWithoutTheRightPermissions()
    {
        // We must first login and visit the dashboard page.
        $user = \Auth::loginUsingId(1);

        // Remove `browse_users` permission
        $user->role->permissions()->detach(
            $user->role->permissions()->where('key', 'browse_posts')->first()
        );

        $this->visit(route('pilot.dashboard'))
            ->see(__('pilot::generic.dashboard'));

        // Test PostDimmer widget
        $this->dontSee('<h4>1 '.trans_choice('pilot::dimmer.post', 1).'</h4>')
             ->dontSee(__('pilot::dimmer.post_link_text'));
    }

    /**
     * PageDimmer widget isn't displayed without the right permissions.
     */
    public function testPageDimmerWidgetIsNotShownWithoutTheRightPermissions()
    {
        // We must first login and visit the dashboard page.
        $user = \Auth::loginUsingId(1);

        // Remove `browse_users` permission
        $user->role->permissions()->detach(
            $user->role->permissions()->where('key', 'browse_pages')->first()
        );

        $this->visit(route('pilot.dashboard'))
            ->see(__('pilot::generic.dashboard'));

        // Test PageDimmer widget
        $this->dontSee('<h4>1 '.trans_choice('pilot::dimmer.page', 1).'</h4>')
             ->dontSee(__('pilot::dimmer.page_link_text'));
    }

    /**
     * Test See Correct Footer Version Number.
     *
     * This test will make sure the footer contains the correct version number.
     */
    public function testSeeingCorrectFooterVersionNumber()
    {
        // We must first login and visit the dashboard page.
        Auth::loginUsingId(1);

        $this->visit(route('pilot.dashboard'))
             ->see(Pilot::getVersion());
    }
}
