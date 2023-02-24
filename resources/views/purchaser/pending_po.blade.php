@extends('layouts.master')

@section('title') Pending Purchased Orders @endsection

@section('css')
    <!-- DataTables -->
    
     <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Purchaser @endslot
        @slot('title') Pending Purchased Orders @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                   
                    <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                       + Add Purchase Order
                    </button>
                    <!-- Add Onboarding Client Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-md" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Purchase Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                 <form action="store" method="POST">
                                                <div id="basic-example">
                                                    <!-- Seller Details -->
                                                    <h3>Purchase Order For Supplier</h3>
                                                    <section>
                                                       
                                                            @csrf
                                                            
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Supplier <span class="text-danger">*</span></label>
                                                                        <select class="form-control select2" name="supplier_id">
                                                                           
                                                                            @foreach ($supplier as $sup )
                                                                                <option value="{{$sup->id}}" >{{$sup->company_name}}</option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-sm-12">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">P.O #</label>
                                                                        <input type="text" class="form-control" id="basicpill-lastname-input" value=""  name="purchase_order" placeholder="Enter the purchase order number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">Notes</label>
                                                                        <textarea class="form-control" name="description" placeholder="Enter some notes about the purchase order"></textarea>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                                                                               
                                                        </section>
                                                </div>

                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        
                                        <!-- end card -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="add_supplier" class="btn btn-primary">Save</button>
                                    </div>
                            </div>
                        </form>
                        </div>
                    </div>

                  
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Purchase Order</th>
                                <th>No. of Items</th>
                                <th>Description</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Agent/Added by</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->purchase_order}}</td>
                                 <td>{{$order->item_count}}</td>
                                <td>{{$order->description}}</td>
                                <td>${{number_format($order->total,2)}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{date('M d Y h:i:s a',strtotime($order->created_at))}}</td>
                                <td> 
                                    <a id="view" href="edit/{{$order->id}}" ><i class="bx bx-xs bx-edit mr-2"></i> </a> 
                                   
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
