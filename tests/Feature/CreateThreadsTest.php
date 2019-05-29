<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guest_may_not_create_forum_threads()
    {
        $this->withExceptionHandling()
             ->get('/threads/create')
             ->assertRedirect('/login');
        
        $this->post('/threads')
             ->assertRedirect('/login');

    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given that we have a signed in user.
        $this->actingAs(factory('App\User')->create());

        // When we hit the endpoint to create a new thread.
        $thread = factory('App\Thread')->create();

        $this->post('/threads', $thread->toArray());
        // Then, when we visit the thread page.

        $response = $this->get($thread->path());
        // We should see the thread.

        $response->assertSee($thread->title)
             ->assertSee($thread->body);

    }
}
