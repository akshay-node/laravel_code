<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\Jwtapi;

class SendMailFired 
{
    
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMail $event): void
    {
        
        $token = Str::random(30);
        $domain = URL::to('/');
        $url = $domain . '/resert_password' . '/' . $token;
        $data['url'] = $url;
        $data['email'] = $event->email;
        $data['title'] = 'Password Reset';
        $data['body'] = 'please click on below link to resert your password';
     

       Mail::send('forgetpasswordMail', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });


        $data = Jwtapi::where('email', '=', $event->email)->first();
        $data->token = $token;
        $data->status = '0';
        $data->save();


    }
}
