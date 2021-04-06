<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileModel;
use App\Models\MessageModel;
use App\Models\MessageRecipientModel;
use App\Events\MessageSendEvent;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function getAllUser()
    {
        $userId = session()->get('userId');
        $profiles = ProfileModel::select(['user_id as id','name'])->where('user_id','!=',$userId)->get();
        // return response()->json([
        //     'id'
        // ])
        return $profiles;
    }

    public function store(Request $req)
    {
        if(session()->has('userId'))
        {
            $sender_id = session()->get('userId');
            $receiver_id = $req->input('recipient');
            $text = $req->input('message');
            try{
                $message = MessageModel::create(['text'=>$text]);
                $message_recipient = MessageRecipientModel::create([
                    'message_id' => $message->id,
                    'creator_id' => $sender_id,
                    'recipient_id' => $receiver_id
                ]);
                $data = [
                    'text' => $message->text,
                    'sender' => $message_recipient->creator_id,
                ];
                event(new MessageSendEvent($data));
                return 1;
            }
            catch(\Exception $e)
            {
                return response()-json([
                    'error' => "Somthing went to Wrong",
                    'status' => 404
                ]);
            }
        }
        return redirect('/blog');
    }
    public function showMessages($receiver_id)
    {
        if(session()->has('userId'))
        {
            $sender_id = session()->get('userId');

            try{
                $messages = DB::table('message_recipients as mr')
                            ->join('messages as m','m.id','=','mr.message_id')
                            
                            ->select('m.text','mr.creator_id as sender','mr.recipient_id as reciver')
                            ->where(function($query) use ($receiver_id,$sender_id){
                                $query->where('mr.creator_id','=',$sender_id)
                                    ->where('mr.recipient_id','=',$receiver_id);
                            })
                            ->orWhere(function($query) use ($receiver_id,$sender_id){
                                $query->where('mr.creator_id','=',$receiver_id)
                                    ->where('mr.recipient_id','=',$sender_id);
                            })
                            ->orderBy('mr.message_id','asc')
                            ->get();
                return $messages;
            }
            catch(\Exception $e)
            {
                return response()->json([
                    'status' => 404,
                    'error' => "Something went to wrong"
                ]);
            }
        }
        return redirect('/blog');
    }
}
