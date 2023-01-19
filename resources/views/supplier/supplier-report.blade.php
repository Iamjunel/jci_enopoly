@extends('layouts.master')

@section('title') Prospected Supplier List By Date @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Sourcer @endslot
        @slot('title') Prospected Supplier List By Date @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Prospected Supplier Reports are the supplier reports by the company to be part of.
                    </p>
                   
                    <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>ASIN</th>
                                <th>Company Name</th>
                                <th>Website Link</th>
                                <th>Email Address</th>
                                <th>ASIN</th>
                                <th>Contact</th>                        
                                <th>Status</th>
                                <th>Date Added</th>
                                <th>Added By</th>
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
                                <td>{{$client->asin}}</td>
                                <td>{{$client->phone}}</td>
                                
                                <td> 
                                    @if($client->status == "Incomplete")
                                    <span class="badge badge-pill badge-soft-danger font-size-11">
                                    @else 
                                    <span class="badge badge-pill badge-soft-success font-size-11">
                                    @endif    
                                        {{ucfirst($client->status)}} </span>
                                </td>
                                <td>{{date('M d Y',strtotime($client->created_at))}}</td>
                                 <td>{{$client->user->name}}</td>
                               
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
