@extends('layouts.master')

@section('title') Valid | Invalid List By Date From {{$date_from}} To {{$date_to}} @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Checker @endslot
        @slot('title') Valid | Invalid Supplier List By Date @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Uncheck Supplier Reports are the supplier reports by the company to be part of.
                    </p>
                     <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="../supplier/report-with-date" method="POST" class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-12">
                                            @csrf
                                            <div class="input-group">
                                                <div class="input-group-text">From</div>
                                                 <input class="form-control" type="date" name="date_from" value="{{$date_from}}" id="example-date-input">
                                            </div>
                                            
                                        </div>

                                        

                                        <div class="col-12">
                                            <div class="input-group">
                                                <div class="input-group-text">To</div>
                                                 <input class="form-control" type="date" name="date_to" value="{{$date_to}}" id="example-date-input">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            
                                            <select class="form-select" id="inlineFormSelectPref" name="status">
                                                <option value="Valid" {{($status == 'Valid')?'selected' : ''}}>Valid</option>
                                                <option value="Invalid" {{($status == 'Invalid')?'selected' : ''}}>Invalid</option>
                                            </select>
                                        </div>
                                        

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-md">Get Report</button>
                                        </div>
                                    </form>

                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                   
                    <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>ASIN</th>
                                <th>Company Name</th>
                                <th>Website Link</th>
                                <th>Email Address</th>
                                <th>Contact</th>                        
                                <th>Status</th>
                                <th>Date Updated</th>
                                <th>Checked By</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($supplier as $client)
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
                                    @else 
                                    <span class="badge badge-pill badge-soft-warning font-size-11">
                                    @endif    
                                        {{ucfirst($client->status)}} </span>
                                </td>
                                <td>{{date('M d Y',strtotime($client->checker_updated_at))}}</td>
                                 <td>{{$client->checker->name}}</td>
                               
                            </tr>
                                
                            @endforeach
                            
                           
                            
                            
                        </tbody>
                    </table>


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    
@endsection
