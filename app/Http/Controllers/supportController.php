<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\ticket;
use App\comment;
use App\file_comment;
use App\ticket_file;
use Auth;
use Gate;
class supportController extends Controller
{
    //
    public function index()
    {
      # code...
      $categories = category::where('active', 1)->get();
      return view('support.index',compact('categories'));
    }
    public function create($id)
  	{
  		# code...
      $categories = category::where('active', 1)->get();
      return view('support.create',compact('categories','id'));
  	}
    public function insert(Request $request, $id)
  	{
  		# code...
      $input = $request->all();
  		$v = ticket::validate($request->all());
			$credentials = $request->only('title', 'category', 'text', 'files');
      $credentials['user_id'] = Auth::id();
      if ($v->passes()) {
  			$ticket= ticket::create($credentials);
        if ( $request->file('files') != NULL ) {
            # code...
            $files = $request->file('files');
            foreach ($files as $file) {
                # code...
                $file->getRealPath();
                $file->getClientOriginalName();
                $file->getClientOriginalExtension();
                $file->getSize();
                $file->getMimeType();
                $folder='/upload/files';
                $extension = $file->getClientOriginalExtension();
                $fileName = time().rand(11111,99999).'.'.$extension;
                $destinationPath = base_path().'/'.$folder;
                $file->move($destinationPath,$fileName);
                $ticket_file['ticket_id'] = $ticket->id;
                $ticket_file['file'] = $fileName;
                ticket_file::create($ticket_file);
            }
        }
  			return view('support.create')->with('sent',true);
      }else{
        $categories = category::where('active', 1)->get();
  			return view('support.create',['post'=>$credentials, 'categories'=>$categories, 'id'=>$id])->withErrors($v);
      }
  	}
    //tick
    public function myticket()
    {
      # code...

      if (Gate::allows('admin')) {
        // The current user can update the post...
        $myticket = ticket::orderBy('id','desc')->get();
        return view('support.myticket',compact('myticket'));
      }
      $myticket = ticket::where('user_id', Auth::id())->orderBy('id','desc')->get();
      return view('support.myticket',compact('myticket'));
    }
    public function oneTicket($id)
    {
      # code...
      $oneticket = ticket::findOrFAil($id);
      if (Gate::allows('access',$oneticket)) {
        // The current user can comment in ticket...
        return view('support.oneticket',compact('oneticket'));
      }
      return view('errors.404');
    }
    public function oneTicketPost(Request $request, $id)
    {
      # code...
      $oneticket = ticket::findOrFAil($id);
      if (Gate::allows('access',$oneticket)) {
        // The current user can comment in ticket...
        $input = $request->all();
    		$v = comment::validate($request->all());
  			$credentials = $request->only('comment', 'files');
        if ($v->passes()) {
          if (Gate::allows('admin',$oneticket)) {
            $credentials['own'] = 1;
          }
          if ($request->check_admin) {
            $credentials['check_admin'] = 1;
          }
          //create comment
          $credentials['ticket_id'] = $id;
    			$comment = comment::create($credentials);
          // if is set files
          if ( $request->file('files') != NULL ) {
              # code...
              $files = $request->file('files');
              foreach ($files as $file) {
                  # code...
                  $file->getRealPath();
                  $file->getClientOriginalName();
                  $file->getClientOriginalExtension();
                  $file->getSize();
                  $file->getMimeType();
                  $folder='/upload/files';
                  $extension = $file->getClientOriginalExtension();
                  $fileName = time().rand(11111,99999).'.'.$extension;
                  $destinationPath = base_path().'/'.$folder;
                  $file->move($destinationPath,$fileName);
                  $file_comment['file'] = $fileName;
                  $file_comment['comment_id'] = $comment->id;
                  file_comment::create($file_comment);
              }
          }
          if (Gate::allows('admin',$oneticket)) {
            $jop = (new \App\Jobs\sendmailjob($id, $oneticket->user->name, $oneticket->user->email))->
                  delay( \Carbon\Carbon::now()->addSeconds(5));
                  dispatch($jop);
                  dd($jop);
          }

          return view('support.oneticket',compact('oneticket'))->with('sent',true);
        }else{
          return redirect()->back()->withErrors($v)->withInput();
        }
      }
      return view('errors.404');
    }
}
