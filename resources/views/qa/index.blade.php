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
                                <th>Inbound Shipment</th>
                               
                                <th>Agent</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($products as $product)
                            <tr class="{{($product->qa_status == 'Good To Order')?'bg-info bg-opacity-10' : ''}}">
                                <td>{{$product->amazon_title}}</td>
                                <td>{{$product->amazon_link}}</td>
                                <td>{{$product->asin}}</td>
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
                                    <label for="amazon_title">Amazon Title</label>
                                    <input type="text" class="form-control" id="amazon_title" name="amazon_title" value="{{$product->amazon_title}}" placeholder="Enter amazon title" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="amazon_link">Amazon Link</label>
                                    <input type="text" class="form-control" id="amazon_link" name="amazon_link" value="{{$product->amazon_link}}" placeholder="Enter amazon link"  required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="asin">ASIN</label>
                                    <input type="text" class="form-control" id="asin" name="asin" value="{{$product->asin}}" placeholder="Enter ASIN" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="upc">UPC</label>
                                    <input type="text" class="form-control" id="upc" name="upc"  value="{{$product->upc}}" placeholder="Enter UPC" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="sku">SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku" value="{{$product->sku}}" placeholder="Enter SKU" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" id="category" name="category" value="{{$product->category}}" placeholder="Enter Category" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                               <div class="mb-3">
                                    <label class="col-md-6 ">Supplier</label>
                                    <div class="col-md-12">
                                        <select class="form-select" name="supplier" id="supplier">
                                            @foreach ($supplier as $sup )
                                                <option value="{{$sup->company_name}}" {{($product->supplier == $sup->company_name)? 'selected': ''}} data-link="{{$sup->website_link}}">{{$sup->company_name}}</option>
                                            @endforeach
                                    
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="supplier_link">Supplier Link <a href="" id="supplier_anchor" class="" target="_blank"><i class="bx bx-link-external"></i></a></label>
                                    <input type="text" class="supplier_link form-control" id="supplier_link"  name="supplier_link" value="{{$product->supplier_link}}" placeholder="Enter Supplier Link" required disabled>
                                    <input type="hidden" class="supplier_link form-control"  name="supplier_link" value="{{$product->supplier_link}}">
                                </div>
                            </div>
                            
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="order">No. Of Orders</label>
                                    <input type="number" class="form-control" id="order" name="order" placeholder="0" value="{{$product->order}}" onblur="getTotalCost();" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="multipack">Multipack</label>
                                    <input type="number" id="multipack" class="form-control"  name="multipack" placeholder="0" value="{{$product->multipack}}" onkeyup="getFinalSupplierCost();" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="supplier_cost">Supplier Cost($)</label>
                                    <input type="number" id="supplier_cost" class="form-control" name="supplier_cost"  placeholder="0.0" value="{{$product->supplier_cost}}" onblur="getFinalSupplierCost();" required>
                                    
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="selling_price">Selling Price($)</label>
                                    <input type="number" class="selling_price form-control" id="selling_price" name="selling_price" value="{{$product->selling_price}}" onblur="getProfitPerPiece();" placeholder="0.0">
                                </div>
                            </div>
                            
                            
                        </div>
                        <!-- second row -->
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="fba_fees">FBA Fees($)</label>
                                    <input type="number" class="form-control" id="fba_fees" name="fba_fees" value="{{$product->fba_fees}}" onblur="getTotalCost();" placeholder="0.0" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="label_cost">Label Cost($)</label>
                                    <input type="number" class="form-control" id="label_cost"  name="label_cost" value="{{$product->label_cost}}"  onblur="getTotalCost();" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="shipping_fee">Shipping Fee($)</label>
                                    <input type="number" class="form-control" id="shipping_fee" onblur="getTotalCost();" value="{{$product->shipping_fee}}" name="shipping_fee" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="prep_fee">Prep Fee($)</label>
                                    <input type="number" class="form-control" id="prep_fee" onblur="getTotalCost();" name="prep_fee" value="{{$product->prep_fee}}" placeholder="0.0" required>
                                </div>
                            </div>
                        </div>
                        <!-- third row -->
                        <div class="row">
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="inbound_shipment">Inbound Shipment($)</label>
                                    <input type="number" class="form-control" id="inbound_shipment" value="{{$product->inbound_shipment}}" onblur="getTotalCost();" name="inbound_shipment" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Compt. Sellers</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input"  value="{{$product->label_cost}}"  name="label_cost" placeholder="0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Monthly Sales($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->monthly_sales}}" name="monthly_sales" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="mark_up">Mark Up(%)</label>
                                    <input type="number" class="form-control" id="mark_up" name="mark_up" value="{{$product->mark_up}}" onblur="getMarkUpPrice();" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="col-md-6 ">Process</label>
                                    <div class="col-md-12">
                                        <select class="form-select" name="process">
                                                <option value="RA/TA" {{($product->process == 'RA/TA')? 'selected': ''}}>RA/TA</option>
                                                <option value="Manual" {{($product->process == 'Manual')? 'selected': ''}}>Manual</option>
                                                <option value="Software" {{($product->process == 'Software')? 'selected': ''}}>Software</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="col-md-6 ">Status</label>
                                    <div class="col-md-12">
                                        <select class="form-select" name="status">
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
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="col-md-12 ">Inventory Status</label>
                                    <div class="col-md-12">
                                        <select class="form-select" name="inventory_status">
                                                <option value="NA">NA</option>
                                                
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                    <section class="border-bottom py-2">
                        <h4>Auto Generated Fields</h4>
                        <div class="row">
                             
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="final_supplier_cost">Final Supplier Cost($)</label>
                                    <input type="number" id="final_supplier_cost" class=" final_supplier_cost form-control" value="{{$product->final_supplier_cost}}"  id="basicpill-lastname-input" name="final_supplier_cost" placeholder="0.0" disabled>
                                    <input type="hidden"  class=" final_supplier_cost form-control"  name="final_supplier_cost" value="{{$product->final_supplier_cost}}" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="total_cost">Total Cost($)</label>
                                    <input type="number" class="total_cost form-control" name="total_cost" placeholder="0.0" value="{{$product->total_cost}}" disabled>
                                    <input type="hidden" class="total_cost form-control"  name="total_supplier" value="{{$product->total_cost}}">
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="profit_per_piece ">Profit/Piece($)</label>
                                    <input type="number" class="profit_per_piece form-control" id="profit_per_piece" name="profit_per_piece" value="{{$product->profit_per_piece}}" placeholder="0.0" disabled>
                                    <input type="hidden" class="profit_per_piece form-control"  name="profit_per_piece" placeholder="0.0" value="{{$product->profit_per_piece}}">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="total_profit">Total Profit($)</label>
                                    <input type="number" class="total_profit form-control" id="total_profit" name="total_profit" value="{{$product->total_profit}}" placeholder="0.0" disabled>
                                    <input type="hidden" class="total_profit form-control" id="" name="total_profit" placeholder="0.0" value="{{$product->total_profit}}">
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="margin">Margin(%)</label>
                                    <input type="number" class="margin form-control" id="margin"  name="margin" value="{{$product->margin}}" placeholder="0" disabled>
                                    <input type="hidden" class="margin form-control" id=""  name="margin" value="{{$product->margin}}" placeholder="0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="mark_up_price">Mark-Up Price($)</label>
                                    <input type="number" class="mark_up_price form-control" id="mark_up_price"  name="mark_up_price" value="{{$product->mark_up_price}}" placeholder="0" disabled>
                                    <input type="hidden" class="mark_up_price form-control" id=""  name="mark_up_price" value="{{$product->mark_up_price}}" placeholder="0">
                                </div>
                            </div>
                             <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Agent</label>
                                    <input type="text" class="form-control" id="basicpill-lastname-input" value="{{$product->user->name}}" name="agent" placeholder="Enter the name of the agent" disabled>
                                     <input type="hidden" class="form-control" id="basicpill-lastname-input" value="{{Auth::user()->name}}" name="agent" placeholder="Enter the name of the agent" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Date Added</label>
                                    <input type="date" class="form-control" id="basicpill-lastname-input" value="{{date('Y-m-d',strtotime($product->created_at))}}" name="agent" placeholder="Enter the name of the agent" disabled>
                            
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
    <script>
        function getFinalSupplierCost(){
                var multipack = $('#multipack').val();
                var supplier_cost = $('#supplier_cost').val();
                var total = multipack * supplier_cost;

                $('.final_supplier_cost').val(total.toFixed(2));
                
                getTotalCost();
                getMarkUpPrice();
            }
            function getMarkUpPrice(){
                var markup = $('#mark_up').val();
                var final_supplier_cost = $('.final_supplier_cost').val();
                var total = markup * final_supplier_cost;

                $('.mark_up_price').val(total.toFixed(2));
            }

            function getTotalCost() {
                var label_cost = $('#label_cost').val();
                var fba_fees = $('#fba_fees').val();
                var shipping_fee = $('#shipping_fee').val();
                var prep_fee = $('#prep_fee').val();
                var inbound_shipment = $('#inbound_shipment').val();
                var final_supplier_cost = $('.final_supplier_cost').val();
                console.log(fba_fees);
                console.log(shipping_fee);
                console.log(prep_fee);
                console.log(inbound_shipment);
                console.log(final_supplier_cost);

                var total_cost = parseFloat(label_cost) + parseFloat(fba_fees) + parseFloat(shipping_fee) + parseFloat(prep_fee) + parseFloat(inbound_shipment) + parseFloat(final_supplier_cost);

                $('.total_cost').val(total_cost.toFixed(2));

                getProfitPerPiece();
            }

            function getProfitPerPiece(){
                var selling_price = $('.selling_price').val();
                var total_cost = $('.total_cost').val();
                var profit =  parseFloat(selling_price) -  parseFloat(total_cost);
                $('.profit_per_piece').val(profit.toFixed(2));

                var order = $('#order').val();
                var total_profit = order * parseFloat(profit) ;

                $('.total_profit').val(total_profit.toFixed(2));

                var margin = profit/total_cost;

                $('.margin').val(margin.toFixed(1))
            }
            $(document).ready(function(){
                $('#supplier').change(function(){
                var supplier_link = $(this).children('option:selected').data('link');
                    cleanInput = supplier_link.replace('www.', '');
                    cleanInput = cleanInput.replace('http://', '');
                    cleanInput = cleanInput.replace('https://', '');
                    
                    $('.supplier_link').val(cleanInput);
                    $("#supplier_anchor").attr("href",supplier_link);
                    $('#supplier_anchor').removeClass('hidden');
                });

            });
            

    </script>
@endsection
