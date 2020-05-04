<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Alert;
use App\User;
use Validator;
use Illuminate\Support\Str;
use Mail;

class PagesController extends Controller
{
    //

    public function reset()
    {
        $data = [
        ];
        return view('auth.reset',$data);
    }

    public function reset_post(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $rand = Str::random(6);

        User::where('email', $request->email)->update([
            'reset' => $rand,
        ]);

        $to_name = $request->email;
        $to_email = $request->email;
        $data = array('name'=> $to_name, "body" => "Please use this code to reset the password ".$rand);

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Login 2FA');
            $message->from('info@foteinotaleto.com','Password Reset');
        });

        Alert::success('Success', 'Your Reset Email has been sent to your Email');

        return redirect()->route('reset_get');
    }

    public function reset_get()
    {
        $data = [
        ];
        return view('auth.reset_get',$data);
    }

    public function resetPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'code' => 'required|string',
            'password' => 'required|string',
            'cpassword' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $search = User::where('email', $request->email)->where('reset',  $request->code)->count();

        if ($search > 0){
            User::where('email', $request->email)->update([
                'password' => bcrypt($request->password),
            ]);
            Alert::success('Success', 'Your Reset was successful');

            return redirect()->route('login');
        }

        Alert::success('Success', 'Please confirm the code that was sent to your email');

    }
}
