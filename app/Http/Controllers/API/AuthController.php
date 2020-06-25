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
use App\Feedback;
use Illuminate\Support\Facades\Storage;
use App\Image;
use Aws\Rekognition\RekognitionClient;
use Stripe;
use App\Transaction;
use App\Subscription;




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
            'username' => 'required|string',
            'password' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'error' => true], 200);
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

        $to_name = $request->username;
        $to_email = $request->email;
        $dataz = array('name'=> $to_name, "body" => "Welcome to Picture ID. Get your favourite meal's name and recipe anywhere in the world with our user friendly application mobile applicatio. ");

            Mail::send('emails.mail', $dataz, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Welcome to Picture ID');
                $message->from('support@picturesid.com','Admin');
                });


        return response()->json([
            'message' => 'Successfully created User Account',
            'error' => false
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
            return response()->json(['message' => $validator->errors(), 'error' => true], 200);
        }
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized',
                'error' => true
            ], 200);

        $user = $request->user();

        if($user->type != 0){
            return response()->json([
                'message' => 'You are not a System User, Please try and Login on the company Portal',
                'error' => true
            ], 200);
        }


        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();
        return response()->json([
            'error' => false,
            'status' => $user->sub,
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

        return response()->json(['user' => $user, 'error' => false]);
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
        $to_email = 'jnuary9@gmail.com';
        $data = array('name'=> $to_name, "body" => "Please use this code to reset the password ".$rand);

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Password Reset');
            $message->from('support@picturesid.com','Admin');
        });

        

        return response()->json(['response' => 'A reset link has been sent to your email'], 200);
    }

    public function passwordUpdate(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'error' => true], 200);
        }

            User::where('email', $user->email)->update([
                'password' => bcrypt($request->password),
            ]);
            return response()->json(['response' => 'Your password reset was successful ', 'error' => false], '200');

    }

    public function addFeedback(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'error' => true], 200);
        }

        $user = new Feedback([
            'user_id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'message' => $request->message
        ]);
        $user->save();

            return response()->json(['response' => 'Your feedback has been saved ', 'error' => false], 200);

    }

    public function snapImage(Request $request)
    {
        $user = auth()->user();
        $fileLink = env("FILELINK");
        $uniqueName =  sha1(time());
        $arr = [];

        $client = new RekognitionClient([
            'region'    => env("AWS_DEFAULT_REGION"),
            'version'   => 'latest'
        ]);


        $imagez = str_replace('data:image/jpeg;base64,', '', $request->file);
        $imagez = str_replace(' ', '+', $imagez);
        $bytes = base64_decode($imagez);


        $results = $client->detectLabels([
            'Image'         => ['Bytes' => $bytes], 
            'MinConfidence' => 50
        ]);

        foreach($results as $item)
            {
                array_push($arr, $item);
            break;
            }

            if (count($arr) > 0){


                $filename = $fileLink.$uniqueName;

                $file = Storage::disk('s3')->put('/'.$uniqueName, base64_decode($imagez));

                if($file = true){

                    // $image = new Image([
                    //     'user_id' => $user->id,
                    //     'path' => $filename,
                    //     'type' => $request->type,
                    // ]);
                    // $image->save();

                    return response()->json(['message' =>  $arr, 'image_id' => $filename,  'error' => false, 'type' => $request->type], 200);
                }else{

                    return response()->json(['message' => 'Error uploading image to s3', 'error' => true], 200);
                }
            }else{
                return response()->json(['message' => 'Sorry, We caould not recorgnize this image', 'error' => true], 200);
            }

    }

    public function saveResponse(Request $request)
    {
        $user = auth()->user();

        $image = new Image([
                        'user_id' => $user->id,
                        'path' => $request->image,
                        'type' => $request->type,
                        'title' => $request->name,
                        'body' => $request->source,
                    ]);
                    $image->save();

        return response()->json(['message' =>  $arr, 'image_id' => $filename,  'error' => false, 'type' => $request->type], 200);

    }

    public function discover()
    {
        $user = auth()->user();

        $image = Image::where('user_id', $user->id)->orderby('id', 'desc')->get();

        return response()->json(['images' =>  $image], 200);

    }

    public function explore()
    {

        $image = Image::orderby('id', 'desc')->get();

        return response()->json(['images' =>  $image], 200);

    }

    public function stripePost(Request $request)
    {
        try {

            $user = auth()->user();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer =  Stripe\Customer::create([
            'email' => "sam@gmail.com",
            'source'  => $request->postStripeToken,
        ]);


        $payment = Stripe\Charge::create ([
                "amount" => 4.99 * 100,
                "currency" => "usd",
                "description" => "Test payment from itsolutionstuff.com.",
                "customer" => $customer->id, 
        ]);

        $trans =  new Transaction([
            'user_id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'status' => 'Successful',
            'amount' => 4.99,
        ]);
        $trans->save();

        $sub =  new Subscription([
            'user_id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'status' => 'Successful',
            'amount' => 4.99,
        ]);

        $sub->save();

        User::where('id', $user->id)->update([
            'sub' => 'Subscribed',
            'subDate' => Carbon::now(),
        ]);
          
        return response()->json([ 'error' => false, 'message' =>  'Your payment was successful'], 200);

    }catch (\Exception $e) {

        $trans =  new Transaction([
            'user_id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'status' => 'Failed',
            'amount' => 4.99,
        ]);
        $trans->save();
        return response()->json([ 'error' => true, 'message' => 'There was an issue processing your payment please check your card details and try again'], 200);
        }
    }


}
