@extends('layouts.pdf_layouts')

@section('title') Purchase Order @endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    

  
@endsection


@section('content')
    <div class="row">
    <div class="col-12 ">
        <div class="card px-5">
            <div class="card-body">
                    
                    <section class="border-bottom py-2 d-flex justify-content-between">
                        
                        <div class="col-6" >
                            
                         <h5>Supplier Information</h5>
                         <p class="">
                            <b>{{$order->supplier->asin}}</b><br/>
                            <b>{{$order->supplier->company_name}}</b><br/>
                            {{$order->supplier->email}}<br/>
                            {{$order->supplier->phone}}<br/>
                            {{$order->supplier->website_link}}

                         </p>
                        </div>
                        <div class="col-2 text-right"> 
                            
                         <h5>Order Details</h5>
                         <b>P.O # : {{$order->purchase_order}}</b><br/>
                         <b>Date Created : {{date('M d Y ',strtotime($order->created_at))}}</b><br/>
                         @if($order->description)
                         Notes:
                         <p>{{$order->description}}</p>
                         @endif
                            
                   
                        </div>
                        
                                                                             
                    </section>
                    
                    
                    <section class="border-bottom py-2 my-0">
                   
                   
                    @if($order_details)
                    <div class="">
                        <table class="table mb-0 text-center table-bordered">

                            <thead class="table-dark">
                                <tr>
                                    
                                    <th>Items
                                    </th>
                                    <th>Quantiy</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    
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
                                <tr>
                                    <td colspan="2"></td>
                                    <td ><b>Total:</b></td>
                                    <td class="text-right"><b>{{number_format($total,2)}}</b></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    
                    </div>
                     
                   
                    @endif
                   
                    
                    </section> 
                    <h1 class="page-break"></h1>
                    <section class="border-bottom py-2 ">
                        
                        <div class="col-12" >
                            
                         <h5>Notes/Terms</h5>
                         <pre style="font-family:unset;font-size:90%;margin-bottom:0px">{{$order->description}}
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
