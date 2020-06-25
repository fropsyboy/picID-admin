<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
Use Alert;
use App\Job;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Application;
use App\Feedback;
use App\Transaction;
use App\Subscription;
use Mail;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('type',0)->count();

        $admin = User::where('type',2)->count();

        $free = User::where('type',0)->where('sub', 'trial')->count();

        // dd($user );

            $data = [
                'applications' => [],
                'applicationsCount' => 0,
                'free' => $free ,
                'user' => $user,
                'companies' => $admin,
            ];


            return view('dashboard', $data);

        

    }


    public function profile()
    {
        return view('profile');
    }

    public function profiles($id)
    {
        $profileData = $this->getProfileData($id);

        $getType = User::find($id);

        $data = [
            'profile' => $profileData,
        ];

        if($getType->type == 1){
           return view('user.profile2', $data);
        }

        return view('user.profile', $data);
    }

    public function applicants()
    {
        $user = User::with('credentials')->where('type',0)->orderby('id','desc')->get();

        $data = [
            'applicants' => $user,
        ];

        return view('user.index', $data);
    }

    public function companies()
    {
        $data = [
            'companies' => [],
        ];

        return view('user.companies', $data);
    }

    public function getProfileData($id)
    {
        $result = User::with('credentials')->where('id', $id)->first();

        return $result;
    }

    public function jobs()
    {

        $data = [
            'jobs' => [],
        ];

        return view('user.jobs',$data);
    }

    public function jobsC()
    {
        $user = auth()->user();

        $data = [
            'jobs' => [],
        ];

        return view('user.jobsC',$data);
    }

    public function addJob(Request $request)
    {
  
        Alert::success('Success', 'Your Job has been successfully created');

        return back();
    }

    public function job_status($id, $status)
    {
     
        Alert::success('Success', 'Your Job has been successfully created');

        return back();
  

    }

    public function job_profile($id, $company)
    {

        $profile = User::find($company);

        $job = Job::find($id);

        $data = [
            'job' => $job,
            'profile' => $profile
        ];
        return view('user.job_profile',$data);
    }

    public function application($id)
    {

        $job = Job::find($id);

        $applicant = Application::with('job','user')->where('job_id', $id)->get();


        $data = [
            'job' => $job,
            'applicant' => $applicant
        ];
        return view('user.applicants',$data);
    }

    public function applications()
    {
        $user = auth()->user();


        $data = [
            'applicant' => []
        ];
        return view('user.applications',$data);
    }

    public function admins()
    {
        $user = User::with('credentials')->where('type',2)->orderby('id','desc')->get();

        $data = [
            'admins' => $user 
        ];
        return view('user.admin',$data);
    }

    public function addAdmin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required',
            'username' => 'required|string|unique:users',
            'password' => 'required',
            'cpassword' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $admin = new User([
            'type' => 2,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);
        
        $admin->save();
        $admin->attachRole(5);

        Alert::success('Success', 'Admin Successfully Added');

        return back();
    }

    public function getOneapplication($job_id)
    {
        try {

            $data = [
                'job' => [],
            ];

            return response()->json(['jobs' => $job], 200);

        }catch (\Exception $e) {
            $message =  $e->getMessage();
             Alert::error('Error', $message);
        }
    }

    public function applicant_status($id, $status)
    {
        try {
            $update = "active";
            if($status == "active"){
                $update = "disable";
            }
            Application::where('id', $id)->update([
                'status' => $update
                    ]);


            Alert::success('Success', 'Your Job has been successfully created');

            return back();
        }catch(Exception $e) {
             $message =  $e->getMessage();
             Alert::error('Error', $message);

             return back();
          }
    }

    public function admin_status($id, $status)
    {
        try {
            $update = "active";
            if($status == "active"){
                $update = "disabled";
            }
            User::where('id', $id)->update([
                'status' => $update
                    ]);


            Alert::success('Success', 'Your Job has been successfully created');

            return back();
        }catch(Exception $e) {
             $message =  $e->getMessage();
             Alert::error('Error', $message);

             return back();
          }
    }

    public function request_status($id)
    {
        try {

            Application::where('id', $id)->update([
                'request' => 'yes'
                    ]);


            Alert::success('Success', 'Your Job has been successfully created');

            return back();
        }catch(Exception $e) {
             $message =  $e->getMessage();
             Alert::error('Error', $message);

             return back();
          }
    }

    public function editprodile(Request $request)
    {
        try {
            $user = auth()->user();
            
            
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'm_name' => $request->m_name,
                'l_name' => $request->l_name,
                'phone' => $request->phone,
                    ]);


            Alert::success('Success', 'Your Profile has been successfully created');

            return back();
        }catch(Exception $e) {
             $message =  $e->getMessage();
             Alert::error('Error', $message);

             return back();
          }
    }

    public function feedback()
    {
        $feedbacks = Feedback::orderby('id','desc')->get();

        $data = [
            'applicants' => $feedbacks,
        ];

        return view('user.feedback', $data);
    }

    public function transactions()
    {
        $transactions = Transaction::orderby('id','desc')->get();

        $data = [
            'transactions' => $transactions,
        ];

        return view('user.transactions', $data);
    }

    public function subscriptions()
    {
        $subscriptions = Subscription::orderby('id','desc')->get();

        $data = [
            'subscriptions' => $subscriptions,
        ];

        return view('user.subscriptions', $data);
    }



}

