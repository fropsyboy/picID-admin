@extends('layouts.app')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
        My Applications
        @endslot

        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Jobs</li>
                <li class="breadcrumb-item active">My Applications</li>

            </ol>
        </div>
    @endcomponent
    <div class="table-responsive m-t-40">
                    <table id="config-table" class="table display table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Job Title</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Applicant</th>
                                <th>Gender</th>
                                <th>Location</th>
                                <th>Date</th>
                                
                                @role('employer')
                                <th>Email</th>
                                <th>Phone Number</th>
                                @endrole
                                <th>Status</th>
                                @role('admin')
                                <th>Request</th>
                                @endrole
                                <th>Note</th>
                            </tr>
                        </thead>
                       <tbody>
                       <?php $i = 1; ?>
                       @role('employer')
                        @foreach($applicant as $item)

                        @if($item->job->user_id == Auth::user()->id)
                            <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->job->title}}</td>
                            <td>{{$item->job->type}}</td>
                            <td>{{$item->job->location}}</td>
                            <td>
                                {{$item->user->name}}
                            </td>
                            <td>{{$item->user->gender}}</td>
                            <td>{{$item->user->state}}</td>
                            <td>{{$item->created_at}}</td>
                            
                            @if($item->status == 'active')
                            <td>{{$item->user->email}}</td>
                            <td>{{$item->user->phone}}</td>
                            <td>
                            <span class="btn btn-success btn-sm">Active</span>
                            </td>
                            @else
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>                    
                              
                                    @if($item->request == 'no')
                                    <a href="{{route('request_status',['id' => $item->id])}}" >  
                                    <span class="btn btn-info btn-sm">Request</span>
                                    </a>
                                    @else
                                    <span class="btn btn-primary btn-sm">Pending</span>
                                    @endif

                                    
                            </td>
                            @endif
                            <td>{{$item->note}}</td>
                            @endif
                           
                            </tr>
                        <?php $i++; ?>
                        @endforeach
                        @endrole

                        @role('admin')
                        @foreach($applicant as $item)

                            <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->job->title}}</td>
                            <td>{{$item->job->type}}</td>
                            <td>{{$item->job->location}}</td>
                            <td>
                                    {{$item->user->name}}
                            </td>
                            <td>{{$item->user->gender}}</td>
                            <td>{{$item->user->state}}</td>
                            <td>{{$item->created_at}}</td>
                            
                            <td>                    
                            <a href="{{route('applicant_status',['id' => $item->id, 'status' => $item->status])}}" >    
                                    @if($item->status == 'active')
                                    <span class="btn btn-success btn-sm">Active</span>
                                    @else
                                    <span class="btn btn-danger btn-sm">{{$item->status}}</span>
                                    @endif

                                    </a>
                            </td>
                            <td>
                            @if($item->request == 'yes')
                                    <span class="btn btn-success btn-sm">{{$item->request}}</span>
                                    @else
                                    <span class="btn btn-danger btn-sm">{{$item->request}}</span>
                                    @endif
                            </td>

                            <td>{{$item->note}}</td>
                            </tr>
                        <?php $i++; ?>
                        @endforeach
                        @endrole
                       </tbody>
                    </table>
                </div>
    @endsection