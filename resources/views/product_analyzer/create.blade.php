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
                                    <label for="basicpill-firstname-input">No. Of Orders</label>
                                    <input type="number" class="form-control" id="basicpill-firstname-input" name="order" placeholder="0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Multipack</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" name="multipack" placeholder="0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Supplier Cost($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" name="supplier_cost" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Final Supplier Cost($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" name="final_supplier_cost" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <!-- second row -->
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Selling Price($)</label>
                                    <input type="number" class="form-control" id="basicpill-firstname-input" name="selling_price" placeholder="0.0" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">FBA Fees($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" name="fba_fees" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Label Cost($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input"  name="label_cost" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Shipping Fee($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" name="shipping_fee" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <!-- third row -->
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Prep Fee($)</label>
                                    <input type="number" class="form-control" id="basicpill-firstname-input" name="prep_fee" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Inbound Shipment($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" name="inbound_shipment" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Compt. Sellers</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input"  name="compt_sellers" placeholder="0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Monthly Sales($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" name="monthly_sales" placeholder="0.0">
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
                                    <input type="number" class="form-control" id="basicpill-lastname-input"  name="total_cost" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">Profit/Piece($)</label>
                                    <input type="number" class="form-control" id="basicpill-firstname-input" name="profit_per_piece" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Total Profit($)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input" name="total_profit" placeholder="0.0">
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Margin(%)</label>
                                    <input type="number" class="form-control" id="basicpill-lastname-input"  name="margin" placeholder="0">
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
                                    <input type="text" class="form-control" id="basicpill-lastname-input"  name="agent" placeholder="Enter the name of the agent">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
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
                            <div class="col-lg-4 col-sm-6">
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
