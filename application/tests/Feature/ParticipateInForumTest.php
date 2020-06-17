<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException(AuthenticationException::class);

        $thread = create(Thread::class);

        $reply = create(Reply::class);

        $this->post(route('replies.store', ['thread' => $thread->id]), $reply->toArray());
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_form_threads()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $reply = make(Reply::class);

        $this->post(route('replies.store', ['thread' => $thread->id]), $reply->toArray());

        $this->get(route('threads.show', ['thread' => $thread->id]))
            ->assertSee($reply->body);
    }
}
