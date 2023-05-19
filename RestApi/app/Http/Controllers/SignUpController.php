<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jwtapi;
use App\Models\ResertPassword;
use App\Models\SignUp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Events\SendMail;
use  Illuminate\Support\Facades\Event;

class SignUpController extends Controller
{

    public function login_view()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'box' => ['required'],
            'password' => ['required', 'min:5'],

        ]);

        if ($request->validate) {
            return redirect('login')->withErrors($request->validate);
        } else {
            $em = $request->box;
            $ps = $request->password;
            $data = Jwtapi::where('email', '=', $em)->orwhere('name', '=', $em)->first();
            $user_name = null;
            $emails = null;
            $password = null;

            if (!is_null($data)) {
                $iid = $data['id'];
                $user_name = $data['name'];
                $emails = $data['email'];
                $password = $data['password'];
            }

            if (!((is_null($user_name) || is_null($emails)) && is_null($password))) {

                if (($em == $emails || $user_name == $em) && Hash::check($ps, $password)) {
                    // $wrongs = "login successfull";
                    $request->session()->put('loginid', $iid);
                    return redirect('home');
                } else {
                    return redirect()->back()->withSuccess('Pls enter valid details');
                }
            } else {
                return redirect()->back()->withSuccess('does not exists');
            }
        }
    }


    public function register_view()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'user_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:5'],
            'password_confirmation' => ['required', 'same:password']

        ]);
        if ($request->validate) {
            return redirect('register')->withErrors($request->validate);
        }
        $data = Jwtapi::create([
            'name' => $request['user_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),


        ]);

        return redirect('logins')->withSuccess('register successfully');
    }



    public function logout()
    {
        if (session::has('loginid')) {
            session::flush();
            return redirect('/das');
        }
    }
    public function index()
    {
        return view('home');
    }

    public function forget_view()
    {

        return view('forget');
    }

    public function forget(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],

        ]);
        if (!is_null($request->validate)) {
            return redirect()->back()->withSuccess($request->validate);
        }
        try {

            $data = Jwtapi::where('email', '=', $request->email)->get();
            if (count($data) > 0) {
            Event::dispatch(new SendMail($request->email));

            //     $token = Str::random(30);
            //     $domain = URL::to('/');
            //     $url = $domain . '/resert_password' . '/' . $token;
            //     $data['url'] = $url;
            //     $data['email'] = $request->email;
            //     $data['title'] = 'Password Reset';
            //     $data['body'] = 'please click on below link to resert your password';
             

            //  $mails =   Mail::send('forgetpasswordMail', ['data' => $data], function ($message) use ($data) {
            //         $message->to($data['email'])->subject($data['title']);
            //     });


            //     $data = Jwtapi::where('email', '=', $request->email)->first();
            //     $data->token = $token;
            //     $data->status = '0';
            //     $data->save();

            
                return redirect()->back()->withSuccess('pls check your email');
            } else {
                return redirect()->back()->withSuccess('this email is not registered email');
            }
        } catch (\Exception $e) {


            return redirect()->back()->withSuccess('this email is not registered email');
        }
    }




    public function reset_view(Request $request)
    {

        $resetdata = Jwtapi::where('token', $request->token)->get();
        if (isset($request->token) && $resetdata[0]['status'] == 0) {
            $data = Jwtapi::where('email', $resetdata[0]['email'])->get();
            return view('resetpassword', compact('data'));
        } else {
            return view('404');
        }
    }
    public function resertpassword(Request $request)
    {
        $emails = $request->email;
        $newpassword = $request->password;

        $data = Jwtapi::where('email', '=', $emails)->first();
        $oldpassword =  $data['password'];
        if (Hash::check($newpassword, $oldpassword)) {
            return redirect()->back()->withSuccess('pls enter new password');
        }

        $request->validate([
            'password' => ['required',  'min:5'],
            'confirmpassword' => ['required', 'same:password']

        ]);

        $emails = $request->email;
        $data = Jwtapi::where('email', '=', $emails)->first();
        $data->password = Hash::make($request['password']);
        $data->save();

       
        $sets =  Jwtapi::where('email', $data->email)->first();
        $sets->status = '1';
        $sets->save();
        return response()->json(["your password is reset successfully"],);
    }


}
