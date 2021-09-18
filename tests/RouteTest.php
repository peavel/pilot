<?php

namespace PEAVEL\Pilot\Tests;

class RouteTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testGetRoutes()
    {
        $this->disableExceptionHandling();

        $this->visit(route('pilot.login'));
        $this->type('admin@admin.com', 'email');
        $this->type('password', 'password');
        $this->press(__('pilot::generic.login'));

        $urls = [
            route('pilot.dashboard'),
            route('pilot.media.index'),
            route('pilot.settings.index'),
            route('pilot.roles.index'),
            route('pilot.roles.create'),
            route('pilot.roles.show', 1),
            route('pilot.roles.edit', 1),
            route('pilot.users.index'),
            route('pilot.users.create'),
            route('pilot.users.show', 1),
            route('pilot.users.edit', 1),
            route('pilot.posts.index'),
            route('pilot.posts.create'),
            route('pilot.posts.show', 1),
            route('pilot.posts.edit', 1),
            route('pilot.pages.index'),
            route('pilot.pages.create'),
            route('pilot.pages.show', 1),
            route('pilot.pages.edit', 1),
            route('pilot.categories.index'),
            route('pilot.categories.create'),
            route('pilot.categories.show', 1),
            route('pilot.categories.edit', 1),
            route('pilot.menus.index'),
            route('pilot.menus.create'),
            route('pilot.menus.show', 1),
            route('pilot.menus.edit', 1),
            route('pilot.database.index'),
            route('pilot.bread.edit', 'categories'),
            route('pilot.database.edit', 'categories'),
            route('pilot.database.create'),
        ];

        foreach ($urls as $url) {
            $response = $this->call('GET', $url);
            $this->assertEquals(200, $response->status(), $url.' did not return a 200');
        }
    }
}
