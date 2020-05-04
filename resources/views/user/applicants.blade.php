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
                <li class="breadcrumb-item active">{{$job->title}}</li>
                <li class="breadcrumb-item active">Applicants</li>

            </ol>
        </div>
    @endcomponent
    <div class="table-responsive m-t-40">
                    <table id="config-table" class="table display table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Applicant</th>
                                <th>Gender</th>
                                <th>Location</th>
                                <th>Date</th>
                                
                            </tr>
                        </thead>
                       <tbody>
                       <?php $i = 1; ?>
                        @foreach($applicant as $item)
                            <tr>
                            <td>{{$i}}</td>
                            <td>
                                    {{$item->user->name}}
                            </td>
                            <td>{{$item->user->gender}}</td>
                            <td>{{$item->user->state}}</td>
                            <td>{{$item->created_at}}</td>
                            
                            
                            </tr>
                        <?php $i++; ?>
                        @endforeach
                       </tbody>
                    </table>
                </div>
    @endsection