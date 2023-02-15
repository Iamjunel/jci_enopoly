@extends('layouts.master')

@section('title') Products @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') QA @endslot
        @slot('title') Products @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Products are need to be analyzed or checked if its profitable.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>No. Of Orders</th>
                                <th>Supplier Cost</th>
                                <th>Multipack</th>
                                <th>Final Supplier Cost</th>
                                <th>Selling Price</th>
                                <th>FBA/WFS Fees</th>
                                <th>Label Cost</th>
                                <th>Inbound Shipment</th>
                               
                                <th>Agent</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($products as $product)
                            <tr class="{{($product->qa_status == 'Good To Order')?'bg-info bg-opacity-10' : ''}}">
                                <td>{{$product->order}}</td>
                                 <td>{{$product->supplier_cost}}</td>
                                <td>{{$product->multipack}}</td>
                                <td>{{$product->final_supplier_cost}}</td>
                                <td>{{$product->selling_price}}</td>
                                <td>{{$product->fba_fees}}</td>
                                <td>{{$product->label_cost}}</td>
                                <td>{{$product->inbound_shipment}}</td>
                                <td>{{$product->agent}}</td>
                                <td>{{$product->status}}</td>
                                <td> <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#view-{{$product->id}}"><i class="bx bx-xs bx-zoom-in mr-2"></i> </a> 
                                   
                                 </td>
                                    <!--Update Status Modal -->
                                    <div class="modal fade bs-example-modal-sm" id="status-{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Change Product QA Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="client/update/{{$product->id}}" method="POST">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-12 col-form-label">Client Current Status:</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="status">
                                                                                <option value="Incomplete" {{$product->payment_method == 'Incomplete'}}>Incomplete</option>
                                                                                <option value="Completed" {{$product->payment_method == 'Completed'}}>Completed</option>
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
                                <div class="modal fade bs-example-modal-xl" id="view-{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">To Review Product Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form  action="qa/update/{{$product->id}}" method="POST">
                   
                                                        <section class="border-bottom py-2">
                                                            <h3>Product Details</h3>
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-firstname-input">No. Of Orders</label>
                                                                        <input type="number" class="form-control" id="basicpill-firstname-input" value="{{$product->order}}" name="order" placeholder="0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Multipack</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->multipack}}" name="multipack" placeholder="0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Supplier Cost($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->supplier_cost}}" name="supplier_cost" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Final Supplier Cost($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->final_supplier_cost}}" name="final_supplier_cost" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- second row -->
                                                            <div class="row">
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-firstname-input">Selling Price($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-firstname-input" value="{{$product->selling_price}}" name="selling_price" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">FBA Fees($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->fba_fees}}"  name="fba_fees" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Label Cost($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->label_cost}}"  name="label_cost" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Shipping Fee($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->shipping_fee}}" name="shipping_fee" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- third row -->
                                                            <div class="row">
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-firstname-input">Prep Fee($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-firstname-input" value="{{$product->prep_fee}}" name="prep_fee" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Inbound Shipment($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->inbound_shipment}}" name="inbound_shipment" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Compt. Sellers</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input"  value="{{$product->label_cost}}"  name="label_cost" placeholder="0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Monthly Sales($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->monthly_sales}}" name="monthly_sales" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </section>
                                                        <section class="border-bottom py-2">
                                                            <h4>Auto Generated Fields(In-Progress)</h4>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Total Cost($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->total_cost}}" name="total_cost" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-firstname-input">Profit/Piece($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-firstname-input" value="{{$product->profit_per_piece}}" name="profit_per_piece" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Total Profit($)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->total_profit}}" name="total_profit" placeholder="0.0" disabled>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-3 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Margin(%)</label>
                                                                        <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->margin}}" name="margin" placeholder="0.0 %" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </section>
                                                        <section class="border-bottom py-2">
                                                            <h4>Other Details</h4>
                                                            <div class="row">
                                                                <div class="col-lg-4 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Agent</label>
                                                                        <input type="text" class="form-control" id="basicpill-lastname-input" value="{{$product->agent}}"  name="agent" placeholder="Enter the name of the agent" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 ">Process</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="process" disabled>
                                                                                    <option value="RA/TA" {{($product->process == 'RA/TA')? 'selected': ''}}>RA/TA</option>
                                                                                    <option value="Manual" {{($product->process == 'Manual')? 'selected': ''}}>Manual</option>
                                                                                    <option value="Software" {{($product->process == 'Software')? 'selected': ''}}>Software</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 ">Status</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="status" disabled>
                                                                                    <option value="In-Stock"  {{($product->status == 'In-Stock')? 'selected':''}}>In-Stock</option>
                                                                                    <option value="Out of Stock"  {{($product->status == 'Out of Stock')? 'selected':''}}>Out of Stock</option>
                                                                                    <option value="NP"  {{($product->status == 'NP')? 'selected':''}}>NP</option>
                                                                                    <option value="SA"  {{($product->status == 'SA')? 'selected':''}}>SA</option>
                                                                                    <option value="To Review"  {{($product->status == 'To Review')? 'selected':''}}>To Review</option>
                                                                                    <option value="RB"  {{($product->status == 'RB')? 'selected':''}}>RB</option>
                                                                                    <option value="No Reviews"  {{($product->status == 'No Review')? 'selected':''}}>No Reviews</option>
                                                                                    <option value="No Ratings"  {{($product->status == 'No Ratings')? 'selected':''}}>No Ratings</option>
                                                                                    <option value="Low Margin"  {{($product->status == 'Low Margin')? 'selected':''}}>Low Margin</option>
                                                                                    <option value="Low Monthly Sales"  {{($product->status == 'Low Monthly Sales')? 'selected':''}}>Low Monthly Sales</option>
                                                                                    <option value="Hazmat"  {{($product->status == 'Hazmat')? 'selected':''}}>Hazmat</option>
                                                                                    <option value="Electronics"  {{($product->status == 'Electronics')? 'selected':''}}>Electronics</option>
                                                                                    <option value="NA Amazon"  {{($product->status == 'NA Amazon')? 'selected':''}}>NA Amazon</option>
                                                                                    <option value="Variations"  {{($product->status == 'Variations')? 'selected':''}}>Variations</option>
                                                                                    <option value="Books"  {{($product->status == 'Books')? 'selected':''}}>Books</option>
                                                                                    <option value="Too Heavy"  {{($product->status == 'Too Heavy')? 'selected':''}}>Too Heavy</option>
                                                                                    <option value="No Keepa"  {{($product->status == 'No Keepa')? 'selected':''}}>No Keepa</option>
                                                                                    <option value="NFOWP"  {{($product->status == 'NFOWP')? 'selected':''}}>NFOWP</option>
                                                                                    <option value="NFSR"  {{($product->status == 'NFSR')? 'selected':''}}>NFSR</option>
                                                                                    <option value="Fragile"  {{($product->status == 'Fragile')? 'selected':''}}>Fragile</option>
                                                                                    
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            
                                                            </div>

                                                        </section>
                                                        <section class="border-bottom py-2">
                                                            <h4>QA Status Details</h4>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-6 col-sm-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 ">Status</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="qa_status">
                                                                                    <option value="To Review" {{($product->qa_status == 'To Review')? 'selected': ''}}>To Review</option>
                                                                                    <option value="Good To Order" {{($product->qa_status == 'Good To Order')? 'selected': ''}}>Good To Order</option>
                                                                                    
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </section>

                                                     

                                                </div>
                                                <!-- end card body -->
                                            </div>
                                                <!-- end card -->
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                 <button type="submit" name="add_product" class="btn btn-primary px-4 py-2 mx-1">Save</button>
                                            </div>
                                             </form>
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
