@extends('layouts.app')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Jobs
        @endslot

        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Jobs</li>
                <li class="breadcrumb-item active">Profile</li>
                <a href="{{route('application',['id' => $job->id])}}">
                     <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> View Applicants</button>
                </a>
            </ol>
        </div>
    @endcomponent
    <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Job Details</h5>
                                <form class="form-material form-horizontal">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-6" for="example-email">Title</span>
                                            </label>
                                            <label class="col-md-6" for="example-phone">Location</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="email" id="example-email" name="example-email" class="form-control text-muted" placeholder="enter your email" value="{{$job->title}}" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="example-phone" name="example-phone" class="form-control text-muted" placeholder="enter your phone" data-mask="(999) 999-9999" value="{{$job->location}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-6" for="pwd">Job Type</span>
                                            </label>
                                            <label class="col-md-6" for="cpwd">Experience</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="pwd" name="pwd" class="form-control text-muted" value="{{$job->type}}" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="cpwd" name="cpwd" class="form-control text-muted" value="{{$job->experience}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-6" for="cpwd">Salary</span>
                                            </label>
                                            <label class="col-md-6" for="cpwd">No. Needed</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="cpwd" name="cpwd" class="form-control text-muted" value="{{$job->salary}}" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="cpwd" name="cpwd" class="form-control text-muted" value="{{$job->needed}}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                

                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-6" for="cpwd">Start Date</span>
                                            </label>
                                            <label class="col-md-6" for="cpwd">Expiry Date</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="cpwd" name="cpwd" class="form-control text-muted" value="{{$job->start}}" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" id="cpwd" name="cpwd" class="form-control text-muted" value="{{$job->end}}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Job Description</h5>
                                <form >
                                    <div >
                                        <div class="row">
                                           
                                            <div class="col-md-12">
                                            <textarea class="textarea_editor form-control" rows="15" id="recipient-name" name="description" disabled>
                                                    {{$job->description}}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

    @endsection