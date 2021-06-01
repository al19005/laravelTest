<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Channel;
use App\Models\Join;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tweet $tweet, Follower $follower, Channel $channel, Join $join)
    {
        $user = auth()->user();
        $follow_ids = $follower->followingIds($user->id);
        // followed_idだけ抜き出す
        $following_ids = $follow_ids->pluck('followed_id')->toArray();

        $channel_id = $request->input('channel_id');

        if (empty($channel_id)){
            $channel_id = 1;
        }

        $timelines = $tweet->getTimelines($user->id, $following_ids, $channel_id);

        $join_channels = $join->joinChannels($user->id);
        $join = $join_channels->pluck('channel_id')->toArray();

        $channels = $channel->getChannels($join);

        // $channels = $channel->getchannel();



        $channel_name = $channel->getChannelName($channel_id);

        return view('tweets.index', [
            'user'      => $user,
            'timelines' => $timelines,
            'channels'  => $channels,
            'channel_id'  => $channel_id,
            'channel_name' => $channel_name
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Channel $channel)
    {
        $user = auth()->user();
        $channel_id = $request->input('channel_id');
        $channel_name = $channel->getChannelName($channel_id);

        return view('tweets.create', [
            'user' => $user,
            'channel_name' => $channel_name,
            'channel_id' => $channel_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tweet $tweet)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();
        $tweet->tweetStore($user->id, $data);

        return redirect('tweets');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet, Comment $comment)
    {
        $user = auth()->user();
        $tweet = $tweet->getTweet($tweet->id);
        $comments = $comment -> getComments($tweet->id);

        return view('tweets.show', [
            'user' => $user,
            'tweet' => $tweet,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        $user = auth()->user();
        $tweets = $tweet->getEditTweet($user->id, $tweet->id);

        if (!isset($tweets)) {
            return redirect('tweets');
        }

        return view('tweets.edit', [
            'user'   => $user,
            'tweets' => $tweets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();
        $tweet->tweetUpdate($tweet->id, $data);

        return redirect('tweets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        $user = auth()->user();
        $tweet->tweetDestroy($user->id, $tweet->id);

        return back();
    }
}
