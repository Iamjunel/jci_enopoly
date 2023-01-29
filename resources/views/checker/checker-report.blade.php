@extends('layouts.master')

@section('title') {{$status}} List From {{$date_from}} To {{$date_to}} -- Total {{$status}} : [ {{$supplier_count}} ] @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Checker @endslot
        @slot('title') Uncheck | Valid | Invalid Supplier List By Date @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                   
                     <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="../supplier/report-with-date" method="POST" class="row  g-3 justify-content-between">
                                        <div class="col-7 d-flex gap-3 ">
                                            <div class="col-3">
                                                @csrf
                                                <div class="input-group">
                                                    <div class="input-group-text">From</div>
                                                    <input class="form-control" type="datetime-local" name="date_from" value="{{date("Y-m-d\TH:i:s",strtotime($date_from))}}" id="example-date-input">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="input-group">
                                                    <div class="input-group-text">To</div>
                                                    <input class="form-control" type="datetime-local" name="date_to" value="{{date("Y-m-d\TH:i:s",strtotime($date_to))}}" id="example-date-input">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                
                                                <select class="form-select" id="inlineFormSelectPref" name="status">                                                    
                                                    <option value="Valid" {{($status == 'Valid')?'selected' : ''}}>Valid</option>
                                                    <option value="Invalid" {{($status == 'Invalid')?'selected' : ''}}>Invalid</option>
                                                    <option value="Uncheck" {{($status == 'Uncheck')?'selected' : ''}}>Uncheck</option>
                                                </select>
                                            </div>
                                            

                                            <div class="col-3">
                                                <button type="submit" class="btn btn-primary w-md">Get Report</button>
                                            </div>
                                        </div>
                                         
                                        <div class="col-2 d-flex justify-content-end">
                                        
                                        <button type="button" class="btn btn-outline-secondary">
                                            {{$status}} <span class=" text-danger  ms-2">{{$supplier_count}}</span>
                                        </button>
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
                                <th>Company Name</th>
                                <th>ASIN</th>
                                
                                <th>Website Link</th>
                                <th>Email Address</th>
                                <th>Contact</th>  
                                 <th>Notes</th>                        
                                <th>Status</th>
                                @if($status == "Uncheck")
                                <th>Date Added</th>
                                <th>Added By</th>
                                @else
                                <th>Date Updated</th>
                                <th>Checked By</th>
                                @endif
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($supplier as $client)
                            <tr>
                               <td>{{$client->company_name}}</td>
                                <td>{{$client->asin}}</td>
                                
                                <td><a href="{{$client->website_link}}" target="blank_">{{$client->website_link}}</a></td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone}}</td>
                                <td>{{$client->notes }}</td>
                                
                                <td> 
                                    @if($client->status == "Valid")
                                    <span class="badge badge-pill badge-soft-info font-size-11">
                                    @else 
                                    <span class="badge badge-pill badge-soft-warning font-size-11">
                                    @endif    
                                        {{ucfirst($client->status)}} </span>
                                </td>
                                
                                @if($status = "Uncheck")
                                 <td>{{date('M d Y @ h:i:s a',strtotime($client->created_at))}}</td>
                                <td>{{$client->user->name}}</td>
                                @else
                                <td>{{date('M d Y @ h:i:s a',strtotime($client->checker_updated_at))}}</td>
                                 <td>{{$client->checker->name}}</td>
                                @endif
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
