<?php

namespace App\Http\Controllers;

use App\User;
use App\Allocation;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MailController extends Controller
{
    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmailReminder(Request $request, $id)
    {
        $user = User::findOrFail($id);

        Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
            $m->from('nakalissi@gmail.com', 'Hardworking Hire');

            $m->to($user->email, $user->name)->subject('Labour registered!');
        });
    }
    
    public function send(Request $request)
    {
      dump($request);
        $title = $request->input('title');
        $content = $request->input('content');
        $attach = '';

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message) use ($attach)
        {
            $message->from('nakalissi@gmail.com', 'Daniel');
            $message->to($request->input('email'));
            $message->attach($attach);
            $message->subject("Hello");
        });
        return response()->json(['message' => 'Request completed']);
    }

    public function notify(Request $request){
        //List ID from .env
        $listId = env('MAILCHIMP_LIST_ID');
        //Mailchimp instantiation with Key
        $mailchimp = new \Mailchimp(env('MAILCHIMP_KEY'));
        //Create a Campaign $mailchimp->campaigns->create($type, $options, $content)
        $campaign = $mailchimp->campaigns->create('regular', [
            'list_id' => $listId,
            'subject' => 'New Article from Scotch',
            'from_email' => 'pub@gmail.com',
            'from_name' => 'Scotch Pub',
            'to_name' => 'Scotch Subscriber'
        ], [
            'html' => $request->input('content'),
            'text' => strip_tags($request->input('content'))
        ]);
        //Send campaign
        $mailchimp->campaigns->send($campaign['id']);
        return response()->json(['status' => 'Success']);
    }
}