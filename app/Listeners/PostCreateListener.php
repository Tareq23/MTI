<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostCreateEvent;
use App\Models\RoleModel;
use App\Models\NotificationModel;
use DB;
use App\Models\UserModel;
class PostCreateListener
{
    public function __construct()
    {
        
    }
   
    public function handle($event)
    {
        // $admin_role = RoleModel::select('id')->where('name','=','admin')->first();
        // $admin = DB::table('user_roles')->where('role_id','=',$admin_role->id)->first();
        // $current_user = UserModel::findOrFail(session()->get('userId'));
        // $data = [
        //     'type' => 'post',
        //     'details' => $event->post,
        //     'created_by' => $current_user->name,
        // ];
        // $notify = NotificationModel::create(['data'=>json_encode($data)]);
        // $notify->users()->attach($admin->user_id);
    }
}
