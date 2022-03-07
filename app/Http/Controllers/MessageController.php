<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function create(Request $request){
        $message= new Message();
        $message->title=$request->title;
        $message->content=$request->content;
        $message->save();
        return redirect('/');
    }
    public function view($id){
        $message=Message::findOrFail($id);
        return view('message',['message'=>$message]);
    }
    public function deletem($id){
        DB::table('messages')->where('id', $id)->delete();
        return redirect('/');
    }
    public function update($id){
        $message=Message::findOrFail($id);
        return view('edit',['message'=>$message]);

    }
    public function edit(Request $request,$id){
        DB::table('messages')->updateOrInsert(
        ['id' => $id],
        ['title' => $request->etitle,'content' => $request->econtent,'updated_at'=>date('Y-m-d H:i:s')]
    );
        return redirect('/');
    }
    public function edits($id){
        $message=Message::findOrFail($id);
        $response['data'] = $message;

      return response()->json($response);
    }
}
