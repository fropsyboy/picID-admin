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
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15" data-toggle="modal" data-target="#jobsModal"><i class="fa fa-plus-circle"></i> Create New</button>
        </div>
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            @component('components.table')
                @slot('title')
                    Jobs
                @endslot
                @slot('subtitle')
                    Latest jobs posted by companies 
                @endslot
                <div class="table-responsive m-t-40">
                    <table id="config-table" class="table display table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Job Title</th>
                                <th>No. Needed</th>
                                <th>Start Date</th>
                                <th>End date</th>
                                <th>Salary Range</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                       <tbody>
                       <?php $i = 1; ?>
                        @foreach($jobs as $item)
                            <tr>
                            <td>{{$i}}</td>
                            <td>
                                <a href="{{route('job_profile',['id' => $item->id, 'company' => $item->company])}}" >
                                    {{$item->title}}
                                </a>
                            </td>
                            <td>{{$item->needed}}</td>
                            <td>{{$item->start}}</td>
                            <td>{{$item->end}}</td>
                            <td>{{$item->salary}}</td>
                            <td>{{$item->company->name}}</td>
                            <td>{{$item->location}}</td>
                            <td>
                            <a href="{{route('job_status',['id' => $item->id, 'status' => $item->status])}}" >
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
            @endcomponent
        </div>
    </div>

    <div id="jobsModal" class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="jobsModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Job</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form method="POST" action="{{route('addJob')}}" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="control-label">Title:</label>
                            <input type="text" name="title" class="form-control" id="recipient-name" placeholder="Native Android Developer" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="message-text" class="control-label">Location:</label>
                            <input type="text" class="form-control" name="location" id="recipient-name" placeholder="Lagos, Nigeria" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="recipient-name" class="control-label">Job Type:</label>
                            <input type="text" class="form-control" name="type" id="recipient-name" placeholder="Full Time" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="control-label">Experience:</label>
                            <input type="text" class="form-control" name="experience" id="recipient-name" placeholder="3+ years" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="control-label">Salary:</label>
                            <input type="text" class="form-control" name="salary" id="recipient-name" placeholder="$6k – $10k • No equity" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="recipient-name" class="control-label">No. Needed:</label>
                            <input type="text" class="form-control " name="needed" id="recipient-name" placeholder="3 Personel" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="control-label">Start Date:</label>
                            <input type="text" class="form-control text-muted mydatepicker" name="start" id="bdate" placeholder="YYYY/MM/DD" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="message-text" class="control-label">End Date:</label>
                            <input type="text" class="form-control mydatepicker" name="end" id="recipient-name" placeholder="YYYY/MM/DD" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="control-label" >Job Description:</label>
                            <textarea class="textarea_editor form-control" rows="15" id="recipient-name" name="description" required></textarea>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Post Job</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection