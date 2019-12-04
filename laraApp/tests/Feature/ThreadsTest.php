<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function userCanViewAllThreads()
    {
        $thread = factory('App/Model/Thread')->create();

        $response = $this->get('/threads');
        $response->assertSee($thread->title);
    }

    public function userCanReadSingleThreads()
    {
        $thread = factory('App/Model/Thread')->create();

        $response = $this->get('/thread/' . $thread->id);
        $response->assertSee($thread->title);
    }
}
