@extends('layouts.master')

@section('title')Accounting Invoice @endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
  
@endsection


@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Accounting @endslot
        @slot('title') Edit Order Invoice @endslot
    @endcomponent
    
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                    <section class=" py-2  d-flex justify-content-center ">
                        <div class="col-6">
                        <h4>Items</h4>
                        
                        
                        
                        @if($order_details)
                        <div class="table-responsive">
                            <table class="table mb-0 ">

                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ASIN</th>
                                        <th>Amazon Title</th>
                                        <th>Quantiy</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $total = 0;
                                    ?>
                                    @foreach ($order_details as $or)
                                        <tr >
                                            <th scope="row">{{++$count}}</th>
                                            <td> {{$or->product->asin}}</td>
                                            <td> {{$or->product->amazon_title}}</td>
                                            <td>{{$or->quantity}}</td>
                                            <td>${{ number_format($or->product->selling_price,2)}}</td>
                                            <td>${{number_format($or->quantity * $or->product->selling_price,2)}}</td>
                                           
                                            <?php $total += ($or->quantity * $or->product->selling_price); ?>
                                           <!-- <td style="width:2%"><span><a  class="text-success" href="../destroy-charge/"><i class="bx bx-edit"></i></a></td> -->
                                        </tr>
                                        
                                    
                                        
                                    @endforeach
                                    <tr>
                                        <td colspan="4"></td>
                                        <td ><b>Sub-Total:</b></td>
                                        <td class="text-right"><b>{{number_format($total,2)}}</b></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        
                        </div>
                        
                    
                        @endif
                    
                        </div>
                    </section> 
                    <section class=" py-2 d-flex justify-content-center ">
                        <?php $merchant_fee = 0; ?>
                        <div class="col-6">
                            
                        <button type="button" class="btn btn-primary btn-sm my-2" data-bs-toggle="modal" data-bs-target="#payment_method">
                        Add Payment Method
                        </button>
                        
                        
                        @if(count($invoice_fee))
                        <div class="table-responsive">
                            <table class="table mb-0">

                                <thead class="table-light">
                                    <tr>
                                       
                                        <th>Payment Method</th>
                                        <th>Percentage</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                    @foreach ($invoice_fee as $fee)
                                        <tr >
                                          
                                            <td> {{$fee->payment_method}}</td>
                                            <td> {{$fee->percentage}}</td>
                                            <td>{{$fee->amount}}</td>
                                            <td>${{ number_format($fee->amount *($fee->percentage/100),2)}}</td>
                                            <td style="width:2%"><span><a  class="text-danger" href="../destroy-fee/{{$fee->id}}"><i class="bx bx-trash"></i></a></td>
                                            <?php $merchant_fee += $fee->amount *($fee->percentage/100) ?>
                                        </tr>
                                        
                                    
                                        
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        
                        </div>
                        
                    
                        @endif
                    
                        </div>
                    </section> 
                    <section class="py-2 d-flex justify-content-center">
                     <?php $charges = 0 ;?>
                       <div class="col-6 ">
                        <button type="button" class="btn btn-primary btn-sm my-2" data-bs-toggle="modal" data-bs-target="#charges">
                        Add a Charge
                        </button>
                       
                        
                        @if($invoice_charge)
                        <div class="table-responsive">
                            <table class="table mb-0">

                                
                                <tbody>
                                    
                                    @foreach ($invoice_charge as $charge)
                                        <tr >
                                            <td></td>
                                            <td></td>
                                            <td> {{$charge->name}}($):</td>
                                            <td> {{number_format($charge->amount,2)}}</td>
                                             <td style="width:2%"><span><a  class="text-danger" href="../destroy-charge/{{$charge->id}}"><i class="bx bx-trash"></i></a></td>
                                                <?php $charges += $charge->amount ?>
                                            </tr>
                                        
                                    
                                        
                                    @endforeach
                                    <tr>    
                                        <td style="min-width: 200px"></td>
                                        <td></td>                                    
                                        <td ><b>Discount($):</b></td>
                                        <td class="text-right"><b>{{number_format($invoice->discount,2)}}</b></td>
                                    </tr>
                                    <tr>    
                                        <td></td>
                                            <td></td>                                    
                                        <td ><b>Total:</b></td>
                                        <?php $total += $merchant_fee + $charges - $invoice->discount ?>
                                        <td class="text-right"><b>{{number_format($total,2)}}</b></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        
                        </div>
                        
                    
                        @endif
                       </div>
                    
                    </section> 
                    <form class="repeater" action="../update-invoice/{{$invoice->id}}"  method="POST">
                    @csrf
                    
                    <section class="border-bottom py-5 d-flex justify-content-between">
                        <div class="col-4" >
                            
                        @if($order->store)
                         <h4>Store Information</h4>
                         <p class="py-3">
                            <b>{{$order->store->platform}}</b><br/>
                            <b>{{$order->store->name}}</b><br/>
                            @if($order->client)
                            {{$order->client->firstname}} {{$order->client->lastname}}<br/>
                            @endif
                            @if($order->supplier)
                            {{$order->supplier->email}}<br/>
                            {{$order->supplier->phone}}
                            @endif
                         </p>
                         @endif
                        
                         <div class="row">
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="productdesc">Notes:</label>
                                            <textarea class="form-control" name="notes"  rows="15" >{{$invoice->notes}}</textarea>
                                        </div>
                                    </div>
                            </div>
                         
                       
                        </div>
                        <div class="col-4" >
                         <div class="row">
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="productdesc">Billing Address:</label>
                                            <textarea class="form-control" name="billing_address"  rows="6" >{{$invoice->billing_address}}</textarea>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="productdesc">Shipping Address:</label>
                                            <textarea class="form-control" name="shipping_address"  rows="6" >{{$invoice->shipping_address}}</textarea>
                                        </div>
                                    </div>
                            </div>
                       
                        </div>
                        <div class="col-4"> 
                           
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Invoice Number : <span class="text-danger">*</span></label>
                                        <input type="text" name="invoice_number" class="form-control" value="{{$invoice->invoice_number}}" required/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">P.O/S.O Number :<span class="text-danger">*</span></label>
                                        <input type="text" name="purchase_order" class="form-control" value="{{$order->purchase_order}}" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Invoice Date :<span class="text-danger">*</span></label>
                                        <input type="date" name="invoice_date" class="form-control" value="{{$invoice->invoice_date}}" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Payment Due :<span class="text-danger">*</span></label>
                                        <input type="date" name="payment_due" class="form-control" value="{{$order->payment_due}}" required/>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        
                        
                                                                             
                    </section>
                    
                    <div class="d-flex justify-content-end my-2">
                    
                    <input type="hidden" name="total" value="{{$total}}"/>
                        <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                        <div class="d-flex justify-content-end my-2">
                        <a href="{{ url()->previous() }}" class="btn btn-light px-4 mx-1" >Finish</a>
                        <button type="submit" name="add_client" class="btn btn-primary px-4 mx-1">Save Changes</button>
                        </div>
                    </form>
                    </div>
                <!-- Add Payment Method Modal -->
                    <div class="modal fade" id="payment_method" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-md" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Payment Method</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                 <form action="../store-fee" method="POST">
                                                <div id="basic-example">
                                                    <section>
                                                       
                                                            @csrf
                                                            
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3 col-md-12">
                                                                     
                                                                        <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                                                                         <select class="form-select" name="payment_method">
                                                                                <option value="VISA">VISA</option>
                                                                                <option value="ACH">ACH</option>
                                                                                <option value="AMEX">AMEX</option>
                                                                                <option value="WIRE">WIRE</option>
                                                
                                                                            </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">Percentage(%)</label>
                                                                         <input type="number" class="form-control" name="percentage" value="1"/>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">Amount</label>
                                                                         <input type="number" class="form-control" name="amount" value="0"/>
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
                                       <!-- <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/> -->
                                         <input type="hidden" name="invoice_id" value="{{$invoice->id}}"/>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="add_supplier" class="btn btn-primary">Save</button>
                                    </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!-- Add Charges Modal -->
                    <div class="modal fade" id="charges" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-md" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Charge Fee</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                 <form action="../store-charge" method="POST">
                                                <div id="basic-example">
                                                    <section>
                                                       
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">ChargeName</label>
                                                                         <input type="text" class="form-control" name="name" value="" placeholder="Enter the name of the charge"/>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">Charge Fee($)</label>
                                                                         <input type="number" class="form-control" name="amount" value="0"/>
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
                                       <!-- <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/> -->
                                        <input type="hidden" name="invoice_id" value="{{$invoice->id}}"/>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="add_supplier" class="btn btn-primary">Save</button>
                                    </div>
                            </div>
                        </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
    
    
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    
    <script>
    
     
     </script>
    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    
    
    
    
@endsection
