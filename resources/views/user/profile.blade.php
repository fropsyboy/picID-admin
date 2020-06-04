@extends('layouts.app')
@section('content')
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Profile</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                     <!-- <img src="../assets/images/users/5.jpg" class="img-circle" width="150" /> -->
                                     @if($profile->gender == "Male")
                                    <img src="../assets/images/users/male.png" alt="user-img" class="img-circle" width="150" >
                                    @else
                                    <img src="../assets/images/users/female2.png" alt="user-img" class="img-circle" width="150" >
                                    @endif
                                    <h4 class="card-title m-t-10"> {{$profile->name}} {{$profile->m_name}} {{$profile->l_name}} </h4>
                                    <h6 class="card-subtitle"> {{$profile->username}} </h6>
                                    <h6 class="card-subtitle"> {{$profile->credentials->qualification}} ({{$profile->credentials->examing_body}}) - {{$profile->credentials->career_path}}</h6>
                                    <h6 class="card-subtitle"> {{$profile->credentials->skills}} </h6>

                                   
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6> {{$profile->email}} </h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6>{{$profile->phone}}</h6> <small class="text-muted p-t-30 db">Address</small>
                                <h6>{{$profile->state}}, {{$profile->country}}</h6>
                                
                                 <small class="text-muted p-t-30 db">Social Profile</small>
                                <br/>
                                <a href="{{$profile->credentials?$profile->credentials->facebook:'N/A'}}" class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$profile->credentials?$profile->credentials->twitter:'N/A'}}" class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></a>
                                <a href="{{$profile->credentials?$profile->credentials->linkd:'N/A'}}" class="btn btn-circle btn-secondary"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a> </li>
                                <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li> -->
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                
                                <!--second tab-->
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted"> {{$profile->name}} {{$profile->m_name}} {{$profile->l_name}}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted">{{$profile->phone}} {{$profile->phone2}}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">{{$profile->email}}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                                <br>
                                                <p class="text-muted">{{$profile->state}} {{$profile->country}}</p>
                                            </div>
                                        </div>
                                        <hr>
                    
                                        <div class="row">
                                         <div class="col-md-6 col-xs-6 b-r"> <strong>Skill Set</strong>
                                                <br>
                                                <p class="text-muted"> {{$profile->credentials?$profile->credentials->skills:'N/A'}}</p>
                                            </div>

                                        <div class="col-md-6 col-xs-6 b-r"> <strong>Training Courses</strong>
                                            <br>
                                            <p class="text-muted"> {{$profile->credentials?$profile->credentials->training_courses:'N/A'}}</p>
                                           
                                        </div>
                                        
                                    </div>
                                    <hr>
                                    <div class="row">
                                         <p> <strong>Degree</strong> </p>
                                         <div class="col-md-12 col-xs-6 b-r">
                                         <strong>
                                         
                                        <div class="table-responsive m-t-40">
                                                <table id="config-table" class="table display table-bordered table-striped no-wrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Degree</th>
                                                            <th>Faculty</th>
                                                            <th>Department</th>
                                                            <th>University</th>
                                                            <th>Admission Year</th>
                                                            <th>Graduation Year</th>
                                                            <th>Honour</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                <tbody>
                                                @if($profile->credentials->degree)
                                                @foreach(unserialize($profile->credentials->degree) as $attached)
                                                        <tr>
                                                    
                                                        <td>{{$attached['degree']}}</td>
                                                        <td>{{$attached['faculty']}}</td>
                                                        <td>{{$attached['department']}}</td>
                                                        <td>{{$attached['university']}}</td>
                                                        <td>{{$attached['year_of_admission']}}</td>
                                                        <td>{{$attached['year_of_graduation']}}</td>
                                                        <td>{{$attached['honour']}}</td>
                                                    
                                                        </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                </table>
                                            </div>


                                                </strong> 
                                                <br>
                                            </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                         <p> <strong>Employment History</strong> </p>
                                         <div class="col-md-12 col-xs-6 b-r">
                                         <strong>
                                         
                                        <div class="table-responsive m-t-40">
                                                <table id="config-table" class="table display table-bordered table-striped no-wrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Start Year</th>
                                                            <th>End Year</th>
                                                            <th>Post Held</th>
                                                            
                                                        
                                                            
                                                        </tr>
                                                    </thead>
                                                <tbody>
                                                @if($profile->credentials->employment)
                                                @foreach(unserialize($profile->credentials->employment) as $attached)
                                                        <tr>
                                                    
                                                        <td>{{$attached['name']}}</td>
                                                        <td>{{$attached['role']}}</td>
                                                        <td>{{$attached['start_year']}}</td>
                                                        <td>{{$attached['end_year']}}</td>
                                                        <td>{{$attached['post_held']}}</td>
                                                        
                                                    
                                                        </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                </table>
                                            </div>


                                                </strong> 
                                                <br>
                                            </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                         <div class="col-md-12 col-xs-6 b-r">
                                         <strong>
                                         @if($profile->credentials->subjects)
                                         @foreach(unserialize($profile->credentials->subjects) as $attached2)
                                            {{$attached2}},
                                        @endforeach
                                        @endif
                                                </strong> 
                                                <br>
                                            </div>
                                    </div>

                                    <hr>
                    
                                    <div class="row">
                                    <div class="col-md-6 col-xs-6 b-r"> <strong>CV</strong>
                                            <br>
                                            <!-- <p class="text-muted"> {{$profile->credentials?$profile->credentials->skills:'N/A'}}</p> -->
                                        </div>

                                    <div class="col-md-6 col-xs-6 b-r"> <strong>Certifications</strong>
                                        <br>
                                        <!-- <p class="text-muted"> {{$profile->credentials?$profile->credentials->training_courses:'N/A'}}</p> -->
                                    
                                    </div>
                                    
                                </div>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-md-12">Full Name</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" value="password" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Phone No</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Message</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" class="form-control form-control-line"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12">Select Country</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->

                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
 
@endsection