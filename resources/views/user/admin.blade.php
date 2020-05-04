@extends('layouts.app')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
        Admins
        @endslot

        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Admins</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15" data-toggle="modal" data-target="#jobsModal"><i class="fa fa-plus-circle"></i> Add Admin</button>

        </div>
    @endcomponent
    <div class="table-responsive m-t-40">
                    <table id="config-table" class="table display table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Created at</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                       <tbody>
                       <?php $i = 1; ?>
                        @foreach($admins as $item)
                            <tr>
                            <td>{{$i}}</td>
                            <td>
                                <!-- <a href="{{route('job_profile',['id' => $item->id, 'company' => $item->company])}}" > -->
                                    {{$item->name}}
                                <!-- </a> -->
                            </td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                            <a href="{{route('admin_status',['id' => $item->id, 'status' => $item->status])}}" >
                                    @if($item->status == 'active')
                                    <span class="btn btn-success btn-sm">Active</span>
                                    @else
                                    <span class="btn btn-danger btn-sm">{{$item->status}}</span>
                                    @endif
                                </a>
                            </td>
                           
                            </tr>
                        <?php $i++; ?>
                        @endforeach
                       </tbody>
                    </table>
                </div>

                <div id="jobsModal" class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="jobsModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form method="POST" action="{{route('addAdmin')}}" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="control-label">Name:</label>
                            <input type="text" name="name" class="form-control" id="recipient-name" placeholder="Full Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="message-text" class="control-label">Username:</label>
                            <input type="text" class="form-control" name="username" id="recipient-name" placeholder="example" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="control-label">Email:</label>
                            <input type="text" class="form-control" name="email" id="recipient-name" placeholder="example@example.com" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="message-text" class="control-label">phone Number:</label>
                            <input type="text" class="form-control" name="phone" id="recipient-name" placeholder="+23470635412" required>
                        </div>
                    
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="control-label">Password:</label>
                            <input type="password" class="form-control " name="password" id="recipient-name" placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="message-text" class="control-label">Confirm Password:</label>
                            <input type="password" class="form-control " name="cpassword" id="bdate" placeholder="" required>
                        </div>
                       
                    </div>

                  
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Create Admin</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection