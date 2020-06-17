<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_may_not_create_threads()
    {
        $this->expectException(AuthenticationException::class);

        $thread = make(Thread::class);

        $this->post(route('threads.store'), $thread->toArray());
    }

    /** @test */
    public function guest_cannot_see_create_threads_page()
    {
        $this->withExceptionHandling()->get(route('threads.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = make(Thread::class);

        $this->post(route('threads.store'), $thread->toArray());

        $this->get(route('threads.show', ['thread' => 1]))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
