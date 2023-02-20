@extends('layouts.master')

@section('title') Products @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Product Analyzer @endslot
        @slot('title') Products @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Products are need to be analyzed or checked if its profitable.
                    </p>

                    <a href="product_analyzer/create" class="btn btn-primary waves-effect waves-light my-2"> + Add Product</a>
                    <button type="button" class="btn btn-success waves-effect waves-light my-2" disabled >
                       + Import Excel/CSV File
                    </button>
                    
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Amazon Title</th>
                                <th>Amazon Link</th>
                                <th>ASIN</th>
                                <th>No. Of Orders</th>
                                <th>Supplier Cost</th>
                                <th>Multipack</th>
                                <th>Final Supplier Cost</th>
                                <th>Selling Price</th>
                                <th>FBA/WFS Fees</th>
                                <th>Label Cost</th>
                                <th>Shipping Fee</th>
                                <th>Prep Fee</th>
                                <th>Inbound Shipment</th>
                                <th>Total Cost</th>
                                <th>Profit/Piece</th>
                                <th>Total Profit</th>
                                <th>Margin</th>
                                <th>Montlhy Sales</th>
                                <th>Compt. Sellers</th>
                                <th>Process</th>
                                <th>Agent</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($products as $client)
                            <tr>
                                <td>{{$client->amazon_title}}</td>
                                <td>{{$client->amazon_link}}</td>
                                <td>{{$client->asin}}</td>
                                <td>{{$client->order}}</td>
                                <td>{{$client->supplier_cost}}</td>
                                <td>{{$client->multipack}}</td>
                                <td>{{$client->final_supplier_cost}}</td>
                                <td>{{$client->selling_price}}</td>
                                <td>{{$client->fba_fees}}</td>
                                <td>{{$client->label_cost}}</td>
                                <td>{{$client->shipping_fee}}</td>
                                <td>{{$client->prep_fee}}</td>
                                <td>{{$client->inbound_shipment}}</td>
                                <td>{{$client->total_cost}}</td>
                                <td>{{$client->profit_per_piece}}</td>
                                <td>{{$client->total_profit}}</td>
                                <td>{{$client->margin}}</td>
                                <td>{{$client->monthly_sales}}</td>
                                <td>{{$client->compt_sellers}}</td>
                                <td>{{$client->process}}</td>
                                <td>{{$client->agent}}</td>
                                <td>{{$client->status}}</td>
                                <td> <!--<a id="view" href="#" data-bs-toggle="modal" data-bs-target="#view-{{$client->id}}"><i class="bx bx-xs bx-user mr-2"></i> </a> --> 
                                    <a id="view" href="product_analyzer/edit/{{$client->id}}" ><i class="bx bx-xs bx-pencil mr-1"></i></a>
                                 </td>
                                    <!--Update Status Modal -->
                                    <div class="modal fade bs-example-modal-sm" id="status-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Change Onboarding Client Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="client/update/{{$client->id}}" method="POST">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-12 col-form-label">Client Current Status:</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="status">
                                                                                <option value="Incomplete" {{$client->payment_method == 'Incomplete'}}>Incomplete</option>
                                                                                <option value="Completed" {{$client->payment_method == 'Completed'}}>Completed</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"  name="update_client" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                    </div>
                                    <!-- View Modal -->
                                <div class="modal fade bs-example-modal-xl" id="view-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Onboarding Client Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="basic-example">
                                                        <!-- Seller Details -->
                                                        <h3>Client Details</h3>
                                                        <section>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">First name</label>
                                                                            <input type="text" class="form-control" id="basicpill-firstname-input" placeholder="Enter Your First Name" value="{{$client->firstname}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-lastname-input">Last name</label>
                                                                            <input type="text" class="form-control" id="basicpill-lastname-input" placeholder="Enter Your Last Name" value="{{$client->lastname}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-phoneno-input">Contact No.</label>
                                                                            <input type="text" class="form-control" id="basicpill-phoneno-input" placeholder="Enter Your Phone No." value="{{$client->phone}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-email-input">Email Address</label>
                                                                            <input type="email" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->email}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                   
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Address</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->address}}" disabled>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA)</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->rdia}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA) Id</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->rdia_id}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Added By @ Date</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->user->name}} @ {{date('M d Y',strtotime($client->created_at))}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    @if($client->approved_at)
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Approved by @ Date</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->user->name}} @ {{date('M d Y',strtotime($client->approved_at))}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>                                                            
                                                        </section>
                                                        <h3>Facebook Platform Details</h3>
                                                        <section>
                                                            <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Email Address:</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->fb_email_address}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Password</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->fb_password}}" disabled>
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
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                               
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
