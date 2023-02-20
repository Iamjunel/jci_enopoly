@extends('layouts.master')

@section('title') Product @endsection



@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Product Analyzer @endslot
        @slot('title') Create Product @endslot
    @endcomponent
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <form  action="store" method="POST">
                   
                    <section class="border-bottom py-2">
                         <h3>Product Details</h3>
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="amazon_title">Amazon Title</label>
                                    <input type="text" class="form-control" id="amazon_title" name="amazon_title" placeholder="Enter amazon title" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="amazon_link">Amazon Link</label>
                                    <input type="text" class="form-control" id="amazon_link" name="amazon_link" placeholder="Enter amazon link"  required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="asin">ASIN</label>
                                    <input type="text" class="form-control" id="asin" name="asin" placeholder="Enter ASIN" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="upc">UPC</label>
                                    <input type="text" class="form-control" id="upc" name="upc" placeholder="Enter UPC" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="sku">SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter SKU" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" id="category" name="category" placeholder="Enter Category" required>
                                </div>
                            </div>
                             <div class="col-lg-3 col-sm-6">
                               <div class="mb-3">
                                    <label class="col-md-6 ">Supplier</label>
                                    <div class="col-md-12">
                                        <select class="form-select" name="supplier" id="supplier">
                                             <option disabled selected>Choose a supplier</option>
                                            @foreach ($supplier as $sup )
                                               
                                                <option value="{{$sup->company_name}}"  data-link="{{$sup->website_link}}">{{$sup->company_name}}</option>
                                            @endforeach
                                    
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="supplier_link">Supplier Link <a href="" id="supplier_anchor" class="hidden" target="_blank"><i class="bx bx-link-external"></i></a></label>
                                    <input type="text" class="supplier_link form-control" id="supplier_link"  name="supplier_link" value="" placeholder="Enter Supplier Link" required disabled>
                                    <input type="hidden" class="supplier_link form-control"  name="supplier_link" value="">
                                </div>
                            </div>
                            
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="order">No. Of Orders</label>
                                    <input type="number" class="form-control" id="order" name="order" placeholder="0" onblur="getProfitPerPiece();" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="multipack">Multipack</label>
                                    <input type="number" id="multipack" class="form-control"  name="multipack" placeholder="0" onkeyup="getFinalSupplierCost();" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="supplier_cost">Supplier Cost($)</label>
                                    <input type="number" id="supplier_cost" class="form-control" name="supplier_cost"  placeholder="0.0" onblur="getFinalSupplierCost();" required>
                                    
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="selling_price">Selling Price($)</label>
                                    <input type="number" class="selling_price form-control" id="selling_price" name="selling_price" onblur="getProfitPerPiece();" placeholder="0.0">
                                </div>
                            </div>
                            
                            
                        </div>
                        <!-- second row -->
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="fba_fees">FBA Fees($)</label>
                                    <input type="number" class="form-control" id="fba_fees" name="fba_fees" onblur="getTotalCost();" placeholder="0.0" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="label_cost">Label Cost($)</label>
                                    <input type="number" class="form-control" id="label_cost"  name="label_cost" onblur="getTotalCost();" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="shipping_fee">Shipping Fee($)</label>
                                    <input type="number" class="form-control" id="shipping_fee" onblur="getTotalCost();" name="shipping_fee" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="prep_fee">Prep Fee($)</label>
                                    <input type="number" class="form-control" id="prep_fee" onblur="getTotalCost();" name="prep_fee" placeholder="0.0" required>
                                </div>
                            </div>
                             
                        </div>
                        <!-- third row -->
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="inbound_shipment">Inbound Shipment($)</label>
                                    <input type="number" class="form-control" id="inbound_shipment" onblur="getTotalCost();" name="inbound_shipment" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Compt. Sellers</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input"  name="compt_sellers" placeholder="0" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Monthly Sales($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" name="monthly_sales" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="mark_up">Mark Up(%)</label>
                                    <input type="number" class="form-control" id="mark_up" name="mark_up" onblur="getMarkUpPrice();" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="col-md-6 ">Process</label>
                                    <div class="col-md-12">
                                        <select class="form-select" name="process">
                                                <option value="RA/TA">RA/TA</option>
                                                <option value="Manual">Manual</option>
                                                <option value="Software">Software</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label class="col-md-6 ">Status</label>
                                    <div class="col-md-12">
                                        <select class="form-select" name="status">
                                                <option value="In-Stock">In-Stock</option>
                                                <option value="Out of Stock">Out of Stock</option>
                                                <option value="NP">NP</option>
                                                <option value="SA">SA</option>
                                                <option value="To Review">To Review</option>
                                                <option value="RB">RB</option>
                                                <option value="No Reviews">No Reviews</option>
                                                <option value="No Ratings">No Ratings</option>
                                                <option value="Low Margin">Low Margin</option>
                                                <option value="Low Monthly Sales">Low Monthly Sales</option>
                                                <option value="Hazmat">Hazmat</option>
                                                <option value="Electronics">Electronics</option>
                                                <option value="NA Amazon">NA Amazon</option>
                                                <option value="Variations">Variations</option>
                                                <option value="Books">Books</option>
                                                <option value="Too Heavy">Too Heavy</option>
                                                <option value="No Keepa">No Keepa</option>
                                                <option value="NFOWP">NFOWP</option>
                                                <option value="NFSR">NFSR</option>
                                                <option value="Fragile">Fragile</option>
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
                                    <input type="number" id="final_supplier_cost" class=" final_supplier_cost form-control" id="basicpill-lastname-input" name="final_supplier_cost" placeholder="0.0" disabled>
                                    <input type="hidden"  class=" final_supplier_cost form-control"  name="final_supplier_cost" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="total_cost">Total Cost($)</label>
                                    <input type="number" class="total_cost form-control" name="total_cost" placeholder="0.0" disabled>
                                    <input type="hidden" class="total_cost form-control"  name="total_cost">
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="profit_per_piece ">Profit/Piece($)</label>
                                    <input type="number" class="profit_per_piece form-control" id="profit_per_piece" name="profit_per_piece" placeholder="0.0" disabled>
                                    <input type="hidden" class="profit_per_piece form-control"  name="profit_per_piece" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="total_profit">Total Profit($)</label>
                                    <input type="number" class="total_profit form-control" id="total_profit" name="total_profit" placeholder="0.0" disabled>
                                    <input type="hidden" class="total_profit form-control" id="" name="total_profit" placeholder="0.0">
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="margin">Margin(%)</label>
                                    <input type="number" class="margin form-control" id="margin"  name="margin" placeholder="0" disabled>
                                    <input type="hidden" class="margin form-control" id=""  name="margin" placeholder="0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="mark_up_price">Mark-Up Price($)</label>
                                    <input type="number" class="mark_up_price form-control" id="mark_up_price"  name="mark_up_price" placeholder="0" disabled>
                                    <input type="hidden" class="mark_up_price form-control" id=""  name="mark_up_price" placeholder="0">
                                </div>
                            </div>
                             <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Agent</label>
                                    <input type="text" class="form-control" id="basicpill-lastname-input" value="{{Auth::user()->name}}" name="agent" placeholder="Enter the name of the agent" disabled>
                            
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Date Added</label>
                                    <input type="date" class="form-control" id="basicpill-lastname-input" value="{{date('Y-m-d')}}" name="agent" placeholder="Enter the name of the agent" disabled>
                            
                                </div>
                            </div>
                        </div>

                    </section>
                    
                     <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                      <input type="hidden" name="agent" value="{{Auth::user()->name}}"/>
                     <input type="hidden" name="qa_status" value="To Review"/>
                     <div class="d-flex justify-content-end">
                     <a href="{{route('pa_product.index')}}" class="btn btn-light px-4 py-2 mx-1" >Cancel</a>
                     <button type="submit" name="add_product" class="btn btn-primary px-4 py-2 mx-1">Save</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    
    <script>
        $('#payment_method').change(function() {
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value = $option.val();//to get content of "value" attrib
        var text = $option.text();//to get <option>Text</option> content

        if(text == "CREDIT CARD"){
            $('#credit_card').css('display','block');
        }else{
             $('#credit_card').css('display','none');
        }

        console.log(text);

        
        

        } );
        

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
