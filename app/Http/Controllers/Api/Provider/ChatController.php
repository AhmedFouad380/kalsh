<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function getChat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offer_id' => 'required|exists:offers,id',
        ], [
            'offer_id.required' => 'offer_id_required',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(),$validator->errors()->first());
        }
        $chat  = Chat::where('offer_id',$request->offer_id)->where('provider_id',Auth::guard('provider')->id())->select('id','order_id','offer_id')->firstOrFail();
        $messages = MessageResource::collection(Message::where('chat_id',$chat->id)->orderBy('id','desc')->paginate(20));
       $data['chat']=$chat;
       $data['message']=$messages;
        return callback_data(success(), 'success_response', $data);

    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chat_id' => 'required|exists:chats,id',
            'message'=>'required_without:voice',
            'voice'=>'required_without:message'
        ], [
            'chat_id.required' => 'chat_id_required',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return callback_data(error(), $validator->errors()->first());
        }

        $data = Message::create([
            'chat_id' => $request->chat_id,
            'sender_type' => Provider::class,
            'sender_id' => Auth::guard('provider')->id(),
            'message' => $request->message,
            'voice' => $request->voice,
        ]);

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );


        $pusher->trigger('MessageSent-channel-' . $request->chat_id, 'App\Events\chatEvent', $data);

        return callback_data(success(), 'save_success', $data);
    }
}
