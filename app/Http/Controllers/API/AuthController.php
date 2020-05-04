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
            'type' => 'required',
            'full_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'username' => 'required|string|unique:users',
            'phone' => 'required',
            'password' => 'required|string',
            'cpassword' => 'required|same:password'

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = new User([
            'type' => $request->type,
            'name' => $request->full_name,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();

        if($request->type == 0){
            $user->attachRole(1);
        }else{
            $user->attachRole(2);
        }

        $credential = new Credential([
            'user_id' => $user->id,
        ]);
        $credential->save();
        return response()->json([
            'message' => 'Successfully created User Account'
        ]);
    }


    public function user_details($id)
    {
        $user= User::where('id',$id)->first();

        return response()->json([
            'user' => $user
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

        $credentials = Credential::where('user_id', $user->id)->first();

        $data = [
            'name' => $user->name ? $user->name : 'N/A',
            'gender' => $user->gender  ? $user->gender : 'N/A',
            'dob' => $user->dob ? $user->dob : '01/01/2020',
            'phone' => $user->phone ? $user->phone : 'N/A',
            'phone2' => $user->phone2 ? $user->phone2 : 'N/A',
            'country' => $user->country ? $user->country : 'N/A',
            'state' => $user->state ? $user->state : 'N/A',
            'username' => $user->username ? $user->username : 'N/A',
            'facebook' => $user->facebook ? $user->facebook : 'N/A',
            'twitter' => $user->twitter ? $user->twitter : 'N/A',
            'linkd' => $user->linkd ? $user->linkd : 'N/A',
            'insta' => $user->insta ? $user->insta : 'N/A',
            'email' => $user->email,
            'staff_size' => $user->staff_size ? $user->staff_size : 'N/A',
            'sector' => $user->sector ? $user->sector : 'N/A',
            'industry' => $user->industry ? $user->industry : 'N/A',
            'years' => $user->years ? $user->years : 'N/A',
            'qualification' => $credentials->qualification ? $credentials->qualification : 'N/A',
            'examing_body' => $credentials->examing_body ? $credentials->examing_body : 'N/A',
            'subjects' => $credentials->subjects ? unserialize($credentials->subjects) : null,
            'o_level_passed' => $credentials->o_level_passed ? $credentials->o_level_passed : 'N/A',
            'skills' => $credentials->skills ? $credentials->skills : 'N/A',
            'training_courses' => $credentials->training_courses ? $credentials->training_courses : 'N/A',
            'career_path' => $credentials->career_path ? $credentials->career_path : 'N/A',
            'degree' => $credentials->degree ? unserialize($credentials->degree) : null,
            'employment' => $credentials->employment ? unserialize($credentials->employment) : null

        ];

        $profile_check = collect($data)->contains('N/A');

        $profile_incomplete = [
            'profile_incomplete' => $profile_check
        ];

        array_push($data, $profile_incomplete);
        return response()->json($data);
    }

    public function signupCompany(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'country' => 'required',
            'state' => 'required',
            'staff_size' => 'required',
            'sector' => 'required',
            'industry' => 'required',
            'years' => 'required',
            'contact_person1' => 'required',
            'contact_person2' => 'required',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = new User([
            'name' => $request->company_name,
            'type' => '1',
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'staff_size' => $request->staff_size,
            'sector' => $request->sector,
            'industry' => $request->industry,
            'years' => $request->years,
            'contact_person1' => serialize($request->contact_person1),
            'contact_person2' => serialize($request->contact_person2),
            'description' => $request->description,
            'cac_number' => $request->cac_number,
        ]);
        $user->save();
        $user->attachRole(2);
        return response()->json([
            'message' => 'Successfully created Company Account'
        ]);
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

    public function jobs()
    {
        $currentDate = date('Y-m-d');
        $jobs = Job::with('cleanCompany')->whereDate('end', '>=', $currentDate)->orderby('id','desc')->get();

        $data = [
            'jobs' => $jobs,
        ];

        return response()->json(['jobs' => $jobs], 200);
    }

    public function job($id)
    {
        try {
            $job = Job::with('cleanCompany')->where('id',$id)->first();

            $data = [
                'job' => $job,
            ];

            return response()->json(['jobs' => $job], 200);

        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function applyJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        try {
            $user = auth()->user();

            $check = Application::where('job_id', $request->job_id)->where('user_id',$user->id)->count();

            if($check >= 1){
                return response()->json(['error' => 'You have applied for this Job Already'], 401);
            }

            $user = auth()->user();

            $job = new Application([
                'user_id' => $user->id,
                'job_id' => $request->job_id,
                'note' => $request->note,
            ]);
            $job->save();


            return response()->json(['jobs' => 'Your Job Application was successful'], 200);

        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function applications()
    {
        try {
            $job = Application::with('user', 'job')->orderby('id','desc')->paginate(10);

            $data = [
                'job' => $job,
            ];

            return response()->json(['jobs' => $job], 200);

        }catch (\Exception $e) {
            $message =  $e->getMessage();
             Alert::error('Error', $message);
        }
    }

    public function myApplications()
    {
        try {
            $user = auth()->user();

            $applications = Application::with('job')->where('user_id', $user->id)->orderby('id','desc')->get();

            $data = [
                'applications' => $applications,
            ];

            return response()->json(['data' => $data], 200);

        }catch (\Exception $e) {
            $message =  $e->getMessage();
             Alert::error('Error', $message);
        }
    }

    public function getAttributes()
    {
        $attributes = [
         'title', 'location', 'type', 'experience', 'salary',
        ];

        return response()->json($attributes);
    }

    public function searchJobs(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'query' => 'required|string',
            'category' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $currentDate = date('Y-m-d');

        $search = Job::with('cleanCompany')->where( $request->category, 'like', '%'.$request->get('query').'%' )->whereDate('end', '>=', $currentDate)->orderby('id','desc')->get();

        dd($search);
        $data = [
            'jobs' => $search,
        ];

        return response()->json($data);
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
