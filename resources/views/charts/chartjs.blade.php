@extends('layouts.app')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Chart js
        @endslot
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Chart js</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
        </div>
    @endcomponent
    <div class="row">
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    Line Chart
                @endslot
                <canvas id="chart1" height="150"></canvas>
            @endcomponent
        </div>
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    Bar Chart
                @endslot
                <canvas id="chart2" height="150"></canvas>
            @endcomponent
        </div>
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    Pie Chart
                @endslot
                <canvas id="chart3" height="150"></canvas>
            @endcomponent
        </div>
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    Doughnut Chart
                @endslot
                <canvas id="chart4" height="150"></canvas>
            @endcomponent
        </div>
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    Polar Area Chart
                @endslot
                <canvas id="chart5" height="150"></canvas>
            @endcomponent
        </div>
        <div class="col-lg-6">
            @component('components.chart')
                @slot('title')
                    Radar Chart
                @endslot
                <canvas id="chart6" height="150"></canvas>
            @endcomponent
        </div>
    </div>
@endsection