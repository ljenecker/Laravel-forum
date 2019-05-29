<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    function unauthenticate_user_may_not_add_replies()
    {
        // $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->create();

        $this->withExceptionHandling()
             ->post('threads/some-channel/1/replies')
             ->assertRedirect('/login');
    }

    /** @test */

    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $user = factory('App\User')->create();
        $this->be($user);

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->create();

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }


}
