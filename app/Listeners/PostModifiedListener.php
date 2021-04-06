<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostModifiedEvent;
use App\Models\NotificationModel;
use App\Models\ProfileModel;
class PostModifiedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostModifiedEvent $event)
    {
        $post = $event->post;
        $details = [
            "type" => "post",
            "details" => [
                "title" => $post->title,
                "verified" =>$post->verified,
                "author" => $post->user->name,
                "author_id"=>$post->user_id,
                "post_id"=>$post->id,
            ],
        ];
        $notify = NotificationModel::create(['data'=>json_encode($details)]);
        $users = ProfileModel::all();
        foreach($users as $user)
        {
            $notify->users()->attach($user->user_id);
        }
    }
}
