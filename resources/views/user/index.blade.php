@extends('layouts.app')
@section('content')
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Users</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Users</li>
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
              
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            
                            <h5 class="card-title">Latest Jobs </h5>
                            <h6 class="card-subtitle">Check the latest Users in the system </h6>
                        </div>
                       
                    </div>
                </div>
               
                <div class="table-responsive">
                <table id="config-table" class="table display table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                            <th>S/N</th>
                                <th>Usernamer</th>
                                <th>Email</th>
                                <th>Subscription</th>
                                <th>Status</th>
                                <th>Registerd On</th>
                            </tr>
                        </thead>
                        <?php $i = 1; ?>
                        @foreach($applicants as $item)
                            <tr>
                            <td>{{$i}}</td>
                            <td>
                            {{$item->name}}
                            </td>
                            <td>
                            {{$item->email}}
                            </td>
                            <td>
                                    @if($item->sub == 'trial')
                                    <span class="btn btn-danger btn-sm">Trial Account</span>
                                    @else
                                    <span class="btn btn-success btn-sm">{{$item->sub}}</span>
                                    @endif
                            </td>
                            <td>
                                    @if($item->status == 'active')
                                    <span class="btn btn-success btn-sm">Active</span>
                                    @else
                                    <span class="btn btn-danger btn-sm">{{$item->status}}</span>
                                    @endif
                            </td>
                            <td>
                            {{$item->created_at}}
                            </td>
                            
                            </tr>
                        <?php $i++; ?>
                        @endforeach
                        <tbody>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
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
 
@endsection