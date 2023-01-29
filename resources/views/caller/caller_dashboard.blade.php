@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('css')
<!-- tui charts Css -->
<link href="{{ URL::asset('/assets/libs/tui-chart/tui-chart.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Checker @endslot
@slot('title') Dashboard @endslot
@endcomponent

<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p>Enopoly Dashboard</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid mb-4">
                            <img src="{{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="" class="img-thumbnail rounded-circle">
                        </div>
                        <h5 class="font-size-15 text-truncate">{{ Str::ucfirst(Auth::user()->name) }}</h5>
                        <p class="text-muted mb-0 text-truncate">Checker</p>
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="font-size-15">Daily Supplier Recorded</h5>
                                    
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">{{$supplier_array["daily_supplier_valid"]}}</h5>
                                    <p class="text-muted mb-0">Team Valid Suppliers</p>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-size-15">{{$supplier_array["daily_supplier_invalid"]}}</h5>
                                    <p class="text-muted mb-0">Team Invalid Suppliers</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="checker/supplier/checked" class="btn btn-primary waves-effect waves-light btn-sm">View All <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card" style="height:350px;overflow-y:auto">
            <div class="card-body">
                <h4 class="card-title mb-5">Management Announcement</h4>
                <ul class="verti-timeline list-unstyled">
                   
                    @foreach ($announcement as $announce)
                    @if((date('Y-m-d',strtotime($announce->created_at)) != date('Y-m-d')))
                    <li class="event-list">
                        <div class="event-timeline-dot">
                            <i class="bx bx-right-arrow-circle font-size-18"></i>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <h5 class="font-size-14">{{date('d M',strtotime($announce->created_at))}}<i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                            </div>
                            <div class="flex-grow-1 ">
                                <div class="text-break">
                                    @if(strlen($announce->message) > 50)
                                    {{mb_strimwidth($announce->message,0,50,'...')}}<a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#dash-{{$announce->id}}">Read more</a>
                                     <!--  Readmore Modal-->
                                        <div class="modal fade  bs-example-modal-sm" id="dash-{{$announce->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog  modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Read Announcement Detail</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="font-size-15" style="white-space: pre-wrap">{{$announce->message}}</p>
                                                        <p class="float-end">Posted by: {{$announce->user->name}}</p>   
                                                    </div>
                                                    
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                      
                                                    </div>
                                                   
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    @else
                                    {{$announce->message}}    
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>    
                    @else
                     <li class="event-list active">
                        <div class="event-timeline-dot">
                            <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <h5 class="font-size-14">{{date('d M',strtotime($announce->created_at))}}<i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                            </div>
                            <div class="flex-grow-1">
                                <div class="text-break">
                                    @if(strlen($announce->message) > 50)
                                    {{mb_strimwidth($announce->message,0,50,'...')}}<a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#dash-{{$announce->id}}">Read more</a>
                                     <!--  Readmore Modal-->
                                        <div class="modal fade  bs-example-modal-sm" id="dash-{{$announce->id}}"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog  modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Read Announcement Detail</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="font-size-15" style="white-space: pre-wrap">{{$announce->message}}</p>
                                                        <p class="float-end">Posted by: {{$announce->user->name}}</p>   
                                                    </div>
                                                    
                                                        
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                      
                                                    </div>
                                                   
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    @else
                                    {{$announce->message}}    
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>   
                    @endif
                    @endforeach
                </ul>
                
                <div class="text-center mt-4"><!--<a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View More <i class="mdi mdi-arrow-right ms-1"></i></a> --></div>
            </div>
        </div>
        
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Weekly Supplier(Team)</p>
                                <h4 class="mb-0">{{$supplier_array["weekly_supplier"]}}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-group font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Monthly Supplier(Team)</p>
                                <h4 class="mb-0">{{$supplier_array["monthly_supplier"]}}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center ">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-warning">
                                        <i class="bx bx-group font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Yearly Supplier(Team)</p>
                                <h4 class="mb-0">{{$supplier_array["yearly_supplier"]}}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-success">
                                        <i class="bx bx-group font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="card" style="height:530px;">
            <div class="card-body">
                <div id="column-charts" data-colors='["--bs-success","--bs-primary", "--bs-danger"]' dir="ltr"></div>

            </div>
        </div>
        
       
    </div>
    
</div>
<div class="row col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4"> Latest Daily Valid | Invalid Supplier</h4>
                <div class="table-responsive" style="max-height:400px;overflow-y:auto">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                
                                <th class="align-middle">Full Name</th>
                                <th class="align-middle">ASIN</th>
                        
                                <th class="align-middle">Company Name</th>
                                <th class="align-middle">Website Link</th>
                                <th class="align-middle">Email Address</th>
                                <th class="align-middle">Contact</th>
                                <th class="align-middle">Status</th>
                                <th>Date Added</th>
                                <th>Added By</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier_array["suppliers_data"] as $client)
                            <tr>
                                <td>{{$client->firstname}} {{$client->lastname}}</td>
                                 <td>{{$client->asin}}</td>
                                <td>{{$client->company_name}}</td>
                                <td><a href="{{$client->website_link}}" target="blank_">{{$client->website_link}}</a></td>
                                <td>{{$client->email}}</td>
            
                                <td>{{$client->phone}}</td>
                                <td> 
                                    @if($client->status == "Valid")
                                    <span class="badge badge-pill badge-soft-info font-size-11">
                                        <a id="view" href="#" data-bs-toggle="modal" class="text-info" data-bs-target="#status-{{$client->id}}">{{ucfirst($client->status)}}</a>
                                    @else
                                    <span class="badge badge-pill badge-soft-warning font-size-11">
                                        <a id="view" href="#" data-bs-toggle="modal" class="text-warning" data-bs-target="#status-{{$client->id}}">{{ucfirst($client->status)}}</a>
                                    @endif
                                         </span>
                                </td>
                                 <td>{{date('M d Y',strtotime($client->checker_updated_at))}}</td>
                                 <td>{{$client->checker->name}}</td>
                                
                                
                            </tr>
                                
                            @endforeach
                            
                           
                            
                            
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
        </div>
    </div>
<!-- end row -->


<!-- end row -->


<!-- end row -->



<!-- subscribeModal -->
<div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar-md mx-auto mb-4">
                        <div class="avatar-title bg-light rounded-circle text-primary h1">
                            <i class="mdi mdi-email-open"></i>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <h4 class="text-primary">Subscribe !</h4>
                            <p class="text-muted font-size-14 mb-4">Subscribe our newletter and get notification to stay
                                update.</p>

                            <div class="input-group bg-light rounded">
                                <input type="email" class="form-control bg-transparent border-0" placeholder="Enter Email address" aria-label="Recipient's username" aria-describedby="button-addon2">

                                <button class="btn btn-primary" type="button" id="button-addon2">
                                    <i class="bx bxs-paper-plane"></i>
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/tui-chart/tui-chart.min.js') }}"></script>

<!-- tui charts plugins -->

<script>
// get colors array from the string

function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        
        if (colors) {
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    
                    if (color){
                      color = color.replace(" ", "");
                      return color;
                    }
                    else return newValue;;
                } else {
                    var val = value.split(',');
                    if (val.length == 2) {
                        var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                        rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        }
    }
  }
  

    // column charts
var columnChartColors = getChartColorsArray("column-charts");
if (columnChartColors) {
    var columnChartWidth = $("#column-charts").width();
    var container = document.getElementById('column-charts');
    var data = {
        categories: ['Jun, 2019', 'Jul, 2019', 'Aug, 2019', 'Sep, 2019', 'Oct, 2019', 'Nov, 2019', 'Dec, 2019'],
        series: [
            {
                name: 'Validated',
                data: [50, 30, 50, 70, 60, 40, 10]
            },
            {
                name: 'Approved',
                data: [80, 10, 70, 20, 60, 30, 50]
            },
            {
                name: 'Denied',
                data: [40, 40, 60, 30, 40, 50, 70]
            }
        ]
    };
    var options = {
        chart: {
            width: columnChartWidth,
            height: 450,
            title: 'Onboarded Supplier(In-Progress)',
            format: '1,000'
        },
        yAxis: {
            title: 'No. of Suppliers',
            min: 0,
            max: 90
        },
        xAxis: {
            title: 'Month'
        },
        legend: {
            align: 'top'
        }
    };
    var theme = {
        chart: {
            background: {
                color: '#fff',
                opacity: 0
            },
        },
        title: {
            color: '#8791af',
        },
        xAxis: {
            title: {
                color: '#8791af'
            },
            label: {
                color: '#8791af'
            },
            tickColor: '#8791af'
        },
        yAxis: {
            title: {
                color: '#8791af'
            },
            label: {
                color: '#8791af'
            },
            tickColor: '#8791af'
        },
        plot: {
            lineColor: 'rgba(166, 176, 207, 0.1)'
        },
        legend: {
            label: {
                color: '#8791af'
            }
        },
        series: {
            colors: columnChartColors
        }
    };

    // For apply theme

    tui.chart.registerTheme('myTheme', theme);
    options.theme = 'myTheme';

    var columnChart = tui.chart.columnChart(container, data, options);
}

$( window ).resize(function() {
    columnChartWidth = $("#column-charts").width();
    columnChart.resize({
        width: columnChartWidth,
        height: 450
    });
});

    </script>




<!-- dashboard init -->
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
@endsection