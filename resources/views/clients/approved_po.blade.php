@extends('layouts.master')

@section('title') Approved Client Purchased Orders @endsection

@section('css')
    <!-- DataTables -->
    
     <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Client Corr @endslot
        @slot('title') Approved Client Purchased Orders @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                   
                   
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Purchase Order</th>
                                <th>No. of Items</th>
                                <th>Description</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Agent/Added by</th>
                                
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{date('M d Y h:i:s a',strtotime($order->created_at))}}</td>
                                <td>{{$order->purchase_order}}</td>
                                 <td>{{$order->item_count}}</td>
                                <td>{{$order->description}}</td>
                                <td>${{number_format($order->total,2)}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->user->name}}</td>
                                
                                <td> 
                                    
                                    <a id="view" href="edit-order/{{$order->id}}" ><i class="bx bx-xs bx-edit mr-2"></i> </a> 
                                    <a id="view" href="pdf/{{$order->id}}" target="_blank" ><i class="bx bx-xs bxs-file-pdf mr-2"></i> </a> 
                                   
                                 </td>
                                   
                                
                               
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
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    
@endsection
