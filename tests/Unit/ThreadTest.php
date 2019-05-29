<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    protected function setUp(): void
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
        
    }

    /** @test */
    function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    function a_thread_can_make_a_string_path()
    {
        $thread = factory('App\Thread')->create();

        $this->assertEquals('/threads/' . $thread->channel->slug . '/' . $thread->id, $thread->path());
    }

    /** @test */
    function a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);

    }

    /** @test */
    public function a_thread_can_add_reply()
    {
        $this->thread->addReply([
            'body' => 'FooBar',
            'user_id' => 1,

        ]);

        $this->assertCount(1, $this->thread->replies);

    }

        /** @test */
        public function a_thread_belongs_to_a_channel()
        {
            // $thread = $this->thread;

            // $this->assertInstanceOf('App\Channel', $thread->channel);

            $this->assertInstanceOf('App\Channel', $this->thread->channel);

    
        }
}
