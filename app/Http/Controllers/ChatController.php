<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Chat;
use App\Models\Inbox;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //

    public function avatar_update(Request $request){

        $myInfo = User::where('id',Auth::user()->id)->first();
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/user'), $filename);
            $myInfo['image']= "user/".$filename;
        }
        $myInfo->update();
         return redirect()->back();
    }
    public function users(){
        $users = User::all();
        return view('user',compact('users'));
    }
    public function inbox(){
        $inboxes = Inbox::where('my_id',Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        return view('inbox',compact(['inboxes']));
    }
    public function archive(){
        $inboxes = Archive::where('my_id',Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        return view('archive',compact(['inboxes']));
    }
    public function archived($id){

        $inbbox = Inbox::where('my_id',Auth::user()->id)->where('user_id',$id)->first();
        $arch = Archive::where('my_id',Auth::user()->id)->where('user_id',$id)->first();


        if($arch){
            $arch->update([
                "last_message" => $inbbox->last_message
            ]);
        }else{
            $archive =  new Archive();
            $archive->my_id = $inbbox->my_id;
            $archive->user_id = $inbbox->user_id;
            $archive->last_message = $inbbox->last_message;
            $archive->save();
        }
        $inbbox->delete();
        return redirect()->back();
    }
    public function unarchived($id){

        $inbbox = Inbox::where('my_id',Auth::user()->id)->where('user_id',$id)->first();
        $arch = Archive::where('my_id',Auth::user()->id)->where('user_id',$id)->first();


        if($inbbox){
            $inbbox->update([
                "last_message" => $arch->last_message
            ]);
        }else{
            $inbox =  new Inbox();
            $inbox->my_id = $arch->my_id;
            $inbox->user_id = $arch->user_id;
            $inbox->last_message = $arch->last_message;
            $inbox->save();
        }
        $arch->delete();
        return redirect()->back();

    }
    public function delete($id){
        $sender = Auth::user()->id;
        $receiver = $id;
        $chats =  Chat::where(function ($query) use ($sender, $receiver) {
            $query->where('sender_id', '=', $sender)
                ->Where('receiver_id', '=', $receiver);
        })->orWhere(function ($query) use ($receiver, $sender) {
            $query->where('sender_id', '=', $receiver)
                ->Where('receiver_id', '=', $sender);
        })->delete();
        $inbox = Inbox::where('my_id',Auth::user()->id)->where('user_id',$id)->first();
        $archive = Archive::where('my_id',Auth::user()->id)->where('user_id',$id)->first();
        if($inbox){
            $inbox->delete();
        }
        if($archive){
            $archive->delete();
        }

        return redirect()->back();

    }
    public function chat($id){
        $sender = Auth::user()->id;
        $receiver = $id;
        $chats =  Chat::where(function ($query) use ($sender, $receiver) {
                $query->where('sender_id', '=', $sender)
                    ->Where('receiver_id', '=', $receiver);
            })->orWhere(function ($query) use ($receiver, $sender) {
                $query->where('sender_id', '=', $receiver)
                    ->Where('receiver_id', '=', $sender);
            })->get();
       // return $chats;
        $user = User::where('id',$id)->first();
        $me = User::where('id',Auth::user()->id)->first();
        return view('chat',compact(['me','user','chats']));
    }
    public function send(Request $request){
        $chat = new Chat();
        $chat->sender_id = $request->sender_id;
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->save();

        $userbox = Inbox::where('my_id',Auth::user()->id)->where('user_id',$request->receiver_id)->first();
        $userbox2 = Inbox::where('my_id',$request->receiver_id)->where('user_id',Auth::user()->id)->first();

        if($userbox){
            $userbox->update([
                "last_message" => $request->message
            ]);
        }else{
            $inbox =  new Inbox();
            $inbox->my_id = $request->sender_id;
            $inbox->user_id = $request->receiver_id;
            $inbox->last_message = $request->message;
            $inbox->save();
        }
        if($userbox2){
            $userbox2->update([
                "last_message" => $request->message
            ]);
        }else{
            $inbox =  new Inbox();
            $inbox->my_id = $request->receiver_id;
            $inbox->user_id = $request->sender_id;
            $inbox->last_message = $request->message;
            $inbox->save();
        }

        return redirect()->back();
    }
}
