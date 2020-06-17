<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    /**
     * @test
     */
    public function a_user_can_view_all_threads()
    {
        $this->get(route('threads.index'))
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_read_single_threads()
    {
        $this->get(route('threads.show', ['thread' => $this->thread->id]))
            ->assertSee($this->thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_replies_that_are_associated_with_a_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);

        $this->get(route('threads.show', ['thread' => $this->thread->id]))
            ->assertSee($reply->body);
    }
}
