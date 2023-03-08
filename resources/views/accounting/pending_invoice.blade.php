@extends('layouts.master')

@section('title') Onboarding Client @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Accounting @endslot
        @slot('title')Pending Invoices @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                  
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Invoice Number</th>
                                <th>Billing Address</th>
                                <th>Shipping Address</th>
                                <th>Invoice Date</th>
                                <th>Payment Due</th>
                                <th>Store</th>
                                <th>Client Name </th>
                                <th>Added by</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($invoice as $inv )
                                <tr>
                                    <td>{{date('M d Y h:i:s a',strtotime($inv->created_at))}}</td>
                                    <td>{{$inv->invoice_number}}</td>
                                    <td>{{$inv->billing_address}}</td>
                                    <td>{{$inv->shipping_address}}</td>
                                    <td>{{date('M d Y h:i:s a',strtotime($inv->invoice_date))}}</td>
                                    <td>{{date('M d Y h:i:s a',strtotime($inv->payment_due))}}</td>
                                    <td>{{$inv->store->name}}</td>
                                    <td>{{$inv->client->firstname}} {{$inv->client->lastname}}</td>
                                     <td>{{$inv->user->name}}</td>
                                     <td><a id="view" title="edit invoice" href="edit-invoice/{{$inv->order_id}}" ><i class="bx bx-xs bx-detail mr-2"></i> </a> </td>
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
