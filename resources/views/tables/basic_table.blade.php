@extends('layouts.app')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Table Basic
        @endslot
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Table Basic</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
        </div>
    @endcomponent
    <div class="row">
        <div class="col-lg-6">
            @component('components.table')
                @slot('title')
                    Basic Table
                @endslot
                @slot('subtitle')
                    Add class <code>.table</code>
                @endslot
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Deshmukh</td>
                                <td>Prohaska</td>
                                <td>@Genelia</td>
                                <td><span class="label label-danger">admin</span> </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Deshmukh</td>
                                <td>Gaylord</td>
                                <td>@Ritesh</td>
                                <td><span class="label label-info">member</span> </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Sanghani</td>
                                <td>Gusikowski</td>
                                <td>@Govinda</td>
                                <td><span class="label label-warning">developer</span> </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Roshan</td>
                                <td>Rogahn</td>
                                <td>@Hritik</td>
                                <td><span class="label label-success">supporter</span> </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Joshi</td>
                                <td>Hickle</td>
                                <td>@Maruti</td>
                                <td><span class="label label-info">member</span> </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Nigam</td>
                                <td>Eichmann</td>
                                <td>@Sonu</td>
                                <td><span class="label label-success">supporter</span> </td>
                            </tr>
                        </tbody>  
                    </table>
                </div>
            @endcomponent
        </div>
        <div class="col-lg-6">
            @component('components.table')
                @slot('title')
                    Table Hover
                @endslot
                @slot('subtitle')
                    Add class <code>.table-hover</code>
                @endslot
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Products</th>
                                <th>Popularity</th>
                                <th>Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Milk Powder</td>
                                <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#009efb"], "stroke":["#009efb"]}' data-height="40">0,-3,-2,-4,-5,-4,-3,-2,-5,-1</span> </td>
                                <td><span class="text-danger text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 28.76%</span> </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Air Conditioner</td>
                                <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#009efb"], "stroke":["#009efb"]}' data-height="40">0,-1,-1,-2,-3,-1,-2,-3,-1,-2</span> </td>
                                <td><span class="text-warning text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 8.55%</span> </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>RC Cars</td>
                                <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#009efb"], "stroke":["#009efb"]}' data-height="40">0,3,6,1,2,4,6,3,2,1</span> </td>
                                <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 58.56%</span> </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Down Coat</td>
                                <td><span class="peity-line" data-width="120" data-peity='{ "fill": ["#009efb"], "stroke":["#009efb"]}' data-height="40">0,3,6,4,5,4,7,3,4,2</span> </td>
                                <td><span class="text-info text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 35.76%</span> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endcomponent
        </div> 
        <div class="col-12">
            @component('components.table')
                @slot('title')
                    Bordered Table
                @endslot
                @slot('subtitle')
                    Add<code>.table-bordered</code>for borders on all sides of the table and cells.
                @endslot
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Progress</th>
                                <th>Deadline</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lunar probe project</td>
                                <td>
                                    <div class="progress progress-xs margin-vertical-10 ">
                                        <div class="progress-bar bg-danger" style="width: 35%; height:6px;"></div>
                                    </div>
                                </td>
                                <td>May 15, 2015</td>
                                <td class="text-nowrap">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Dream successful plan</td>
                                <td>
                                    <div class="progress progress-xs margin-vertical-10 ">
                                        <div class="progress-bar bg-warning" style="width: 50%; height:6px;"></div>
                                    </div>
                                </td>
                                <td>July 1, 2015</td>
                                <td class="text-nowrap">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Office automatization</td>
                                <td>
                                    <div class="progress progress-xs margin-vertical-10 ">
                                        <div class="progress-bar bg-success" style="width: 100%; height:6px;"></div>
                                    </div>
                                </td>
                                <td>Apr 12, 2015</td>
                                <td class="text-nowrap">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>The sun climbing plan</td>
                                <td>
                                    <div class="progress progress-xs margin-vertical-10 ">
                                        <div class="progress-bar bg-primary" style="width: 70%; height:6px;"></div>
                                    </div>
                                </td>
                                <td>Aug 9, 2015</td>
                                <td class="text-nowrap">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Open strategy</td>
                                <td>
                                    <div class="progress progress-xs margin-vertical-10 ">
                                        <div class="progress-bar bg-info" style="width: 85%; height:6px;"></div>
                                    </div>
                                </td>
                                <td>Apr 2, 2015</td>
                                <td class="text-nowrap">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tantas earum numeris</td>
                                <td>
                                    <div class="progress progress-xs margin-vertical-10 ">
                                        <div class="progress-bar bg-inverse" style="width: 50%; height:6px;"></div>
                                    </div>
                                </td>
                                <td>July 11, 2015</td>
                                <td class="text-nowrap">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endcomponent            
        </div>
    </div>        
@endsection