@extends('layouts.app')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Dashboard 
        @endslot
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard </li>
            </ol>
            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
        </div>
    @endcomponent
    <div class="card-group">
        @component('components.card')
            @slot('title')
                <h3><i class="icon-screen-desktop"></i></h3>
                <p class="text-muted">SUBSCRIBERS</p>
            @endslot
            @slot('count')
                <h2 class="counter text-primary">{{$applicationsCount}}</h2>
            @endslot
            <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        @endcomponent   
        @component('components.card')
            @slot('title')
                <h3><i class="icon-note"></i></h3>
                <p class="text-muted">FREE TRIAL</p>
            @endslot
            @slot('count')
                <h2 class="counter text-cyan">{{$applicantsCount}}</h2>
            @endslot
            <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        @endcomponent
        @component('components.card')
            @slot('title')
                <h3><i class="icon-doc"></i></h3>
                <p class="text-muted">ADMINS</p>
            @endslot
            @slot('count')
                <h2 class="counter text-purple">{{$companies}}</h2>
            @endslot
            <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        @endcomponent
        @component('components.card')
            @slot('title')
                <h3><i class="icon-bag"></i></h3>
                <p class="text-muted">USERS</p>
            @endslot
            @slot('count')
                <h2 class="counter text-success">{{$user}}</h2>
            @endslot
            <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        @endcomponent
    </div>
                
    <div class="row">
   
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            
                            <h5 class="card-title">Latest Subscribers </h5>
                            <h6 class="card-subtitle">Check the latest Subscribers in the system </h6>
                        </div>
                       
                    </div>
                </div>
               
                <div class="table-responsive">
                <table id="config-table" class="table display table-bordered table-striped no-wrap">
                        <thead>
                            <tr>
                            <th>S/N</th>
                            <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Registerd On</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($applications as $item)
                            <tr>
                           
                            </tr>
                        <?php $i++; ?>
                        @endforeach
                        
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>

      
    </div>


    </div>
    
    


    </div>

    
   
    <!-- ============================================================== -->
    <!-- End Comment - chats -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Over Visitor, Our income , slaes different and  sales prediction -->
    <!-- ============================================================== -->
   
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Todo, chat, notification -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
  
@endsection