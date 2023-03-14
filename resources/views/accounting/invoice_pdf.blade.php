@extends('layouts.pdf_layout_invoice')

@section('title') INVOICE  @endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    

  
@endsection


@section('content')
    <div class="row">
    <div class="col-12 ">
        <div class="card px-5">
            <div class="card-body">
                    
                    <section class="border-bottom py-2 d-flex justify-content-between">
                        
                        <div class="col-3" >
                            
                         <h5 class="font-weight-100 text-secondary">BILL TO</h5>
                         <pre style="font-family:unset;font-size:90%;margin-bottom:0px">{{$invoice->billing_address}}</pre>
                        </div>
                        <div class="col-3" >
                            
                          <h5 class="font-weight-100 text-secondary">SHIP TO</h5>
                        <pre style="font-family:unset;font-size:90%;margin-bottom:0px">{{$invoice->shipping_address}}</pre>
                        </div>
                        <div class="col-2 text-right"> 
                            
                       
                         <p>
                         <b class="mx-3">Invoice Number : </b> {{$invoice->invoice_number}}<br/>
                         <b class="mx-3">P.O/S.O Number : </b> {{$order->purchase_order}}<br/>
                         <b class="mx-3">Invoice Date   :</b>  {{date('M d Y ',strtotime($invoice->invoice_date))}}<br/>
                         <b class="mx-3">Payment Due    :</b>   {{date('M d Y ',strtotime($invoice->payment_due))}}<br/>
                         <b class="mx-3">Amount Due($)  :</b>  {{$invoice->total}}<br/>
                         </p>
                        </div>
                        
                                                                             
                    </section>
                    
                    
                    <section class=" py-2 my-0">
                   
                   
                    @if($order_details)
                    <div class="">
                        <table class="table mb-0 text-center table-bordered">

                            <thead class="table-dark">
                                <tr>
                                    
                                    <th>Items</th>
                                    <th>Quantiy</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $total = 0;
                                ?>
                                @foreach ($order_details as $or)
                                    <tr >
                                        
                                        <td style="text-align: left !important"> <b>{{$or->product->asin}}</b><br/>
                                         {{$or->product->amazon_title}}</td>
                                        <td>{{$or->quantity}}</td>
                                        <td>${{ number_format($or->product->selling_price,2)}}</td>
                                        <td>${{number_format($or->quantity * $or->product->selling_price,2)}}</td>
                                        
                                        <?php $total += ($or->quantity * $or->product->selling_price); ?>
                                    </tr>
                                    
                                
                                    
                                @endforeach
                                 <?php $merchant_fee = 0; ?>
                                   <?php $charges = 0 ;?>
                                @if(count($invoice_fee))
                                    <tr class="table-dark">
                                       
                                        <th style="max-height:300px !important">  Merchant Fee Payment Method</th>
                                        <th>Percentage</th>
                                        <th>Amount</th>
                                        <th>Fee</th>
                                    </tr>
                                    @foreach ($invoice_fee as $fee)
                                        <tr >
                                          
                                            <td> {{$fee->payment_method}}</td>
                                            <td> {{$fee->percentage}} %</td>
                                            <td>$ {{number_format($fee->amount,2)}}</td>
                                            <td>${{ number_format($fee->amount *($fee->percentage/100),2)}}</td>
                                            
                                            <?php $merchant_fee += $fee->amount *($fee->percentage/100) ?>
                                        </tr>
                                        <tr class="table-dark">
                                       
                                        <th style="max-height:300px !important">  </th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @endforeach
                                        @if($invoice_charge)
                       
                                    
                                    @foreach ($invoice_charge as $charge)
                                        <tr >
                                            <td></td>
                                            <td></td>
                                            <td> {{$charge->name}}($):</td>
                                            <td> {{number_format($charge->amount,2)}}</td>
                                            
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
                        @endif
                                   
                       
                      
                        
                        
                                
                            </tbody>
                        </table>
                    
                    </div>
                     
                   
                    @endif
                   
                    
                    </section> 
                     <section class=" py-2 my-0 ">
                       
                        @endif
                    
                        </div>
                    </section> 
                    <section class="py-2 d-flex justify-content-end">
                   
                        
                    
                    
                    </section> 
                    <h1 class="page-break"></h1>
                    <section class="border-bottom py-2 ">
                        
                        <div class="col-12" >
                            
                         <h5>Notes/Terms</h5>
                         <pre style="font-family:unset;font-size:90%;margin-bottom:0px">{{$invoice->notes}}
                         </pre>
                        </div>
                       
                                                                             
                    </section>
                    
                   
                    
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
