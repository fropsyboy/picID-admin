<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Credential;
use App\Job;
use App\Application;
use Illuminate\Support\Str;
use Mail;

class AuthController extends Controller
{
    //
        /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'cpassword' => 'required|same:password'

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = new User([
            'type' => 0,
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();

        $user->attachRole(1);
        

        $credential = new Credential([
            'user_id' => $user->id,
        ]);
        $credential->save();
        return response()->json([
            'message' => 'Successfully created User Account'
        ]);
    }



    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();

        if($user->type != 0){
            return response()->json([
                'message' => 'You are not a System User, Please try and Login on the company Portal'
            ], 400);
        }


        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'access' => $user->type,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user()
    {
        $user = auth()->user();

        return response()->json($user);
    }


    public function updateProfile(Request $request)
    {

        $user = auth()->user();

    try {

            User::where('id', $user->id)->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'phone' => $request->phone,
                'phone2' => $request->phone2,
                'country' => $request->country,
                'state' => $request->state,
                'username' => $request->username,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkd' => $request->linkd,
                'insta' => $request->insta,
                'staff_size' => $request->staff_size,
                'sector' => $request->sector,
                'industry' => $request->industry,
                'years' => $request->years,
            ]);

            Credential::where('user_id', $user->id)->update([
                'qualification' => $request->qualification,
                'examing_body' => $request->examing_body,
                'subjects' => serialize($request->subjects),
                'o_level_passed' => $request->o_level_passed,
                'skills' => $request->skills,
                'training_courses' => $request->training_courses,
                'career_path' => $request->career_path,
                'degree' => serialize($request->degree),
                'employment' => serialize($request->employment),
            ]);

            return response()->json(['success' => 'Details Successfully Updated'], 200);

        }catch (\Exception $e) {
            return response()->json(['error' => $e], 401);
        }
    }


    public function reset(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $check = User::where('email',$request->email)->count();

        if ($check < 1){
            return response()->json(['response' => 'Your Email does not exist in the system'], 400);
        }

        $rand = Str::random(6);

        User::where('email', $request->email)->update([
            'reset' => $rand,
        ]);

        $to_name = $request->email;
        $to_email = $request->email;
        $data = array('name'=> $to_name, "body" => "Please use this code to reset the password ".$rand);

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Password Reset');
            $message->from('info@foteinotaleto.com','Password Reset');
        });

        return response()->json(['response' => 'A reset link has been sent to your email'], 200);
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
            return response()->json(['response' => 'Your password reset was successful '], 200);
        }

        return response()->json(['response' => 'Please check your email and the code sent to your email again '], 400);

    }


}
