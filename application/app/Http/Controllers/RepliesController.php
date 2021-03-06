<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $channel
     * @param Thread $thread
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store($channel, Thread $thread, Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $thread->addReply([
            'body'    => $request->input('body'),
            'user_id' => auth()->id()
        ]);

        return back();
    }
}
