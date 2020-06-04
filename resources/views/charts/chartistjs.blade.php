@extends('layouts.app')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Chartist js
        @endslot
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Chartist js</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
        </div>
    @endcomponent
    <div class="row">
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    Simple Line Chart
                @endslot
                <div class="ct-sm-line-chart" style="height: 400px;"></div>
            @endcomponent
        </div>
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    Line Chart with Area
                @endslot
                <div class="ct-area-ln-chart" style="height: 400px;"></div>
            @endcomponent
        </div>
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    BI-Polar Line Chart
                @endslot
                <div id="ct-polar-chart" style="height: 400px;"></div>
            @endcomponent
        </div>
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    Animation Chart
                @endslot
                <div class="ct-animation-chart" style="height: 400px;"></div>
            @endcomponent
        </div>
    </div>
@endsection