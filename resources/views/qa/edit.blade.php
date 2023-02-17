@extends('layouts.master')

@section('title') Product @endsection



@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Product Analyzer @endslot
        @slot('title') Edit Product @endslot
    @endcomponent
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <form  action="../update/{{$product->id}}" method="POST">
                   
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
                                    <label for="supplier">Supplier</label>
                                    <input type="text" class="form-control" id="supplier" name="supplier" value="{{$product->supplier}}" placeholder="Enter Supplier" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="supplier_link">Supplier Link</label>
                                    <input type="text" class="form-control" id="supplier_link" name="supplier_link" value="{{$product->supplier_link}}" placeholder="Enter Supplier Link" required>
                                </div>
                            </div>
                            
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">No. Of Orders</label>
                                    <input type="number" class="form-control" id="basicpill-firstname-input" value="{{$product->order}}" name="order" placeholder="0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Multipack</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->multipack}}" name="multipack" placeholder="0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Supplier Cost($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->supplier_cost}}" name="supplier_cost" placeholder="0.0">
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
                                    <label for="basicpill-lastname-input">FBA Fees($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->fba_fees}}"  name="fba_fees" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Label Cost($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->label_cost}}"  name="label_cost" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Shipping Fee($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->shipping_fee}}" name="shipping_fee" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Prep Fee($)</label>
                                    <input type="number" class="form-control" id="basicpill-firstname-input" value="{{$product->prep_fee}}" name="prep_fee" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <!-- third row -->
                        <div class="row">
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Inbound Shipment($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" value="{{$product->inbound_shipment}}" name="inbound_shipment" placeholder="0.0">
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
                        </div>

                    </section>
                   
                     <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
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
});
        </script>
    
@endsection
