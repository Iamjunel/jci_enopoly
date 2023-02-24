@extends('layouts.master')

@section('title') Purchase Order @endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    

  
@endsection


@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Purchaser @endslot
        @slot('title') Generate Purchase Order PDF @endslot
    @endcomponent
    <div class="row">
    <div class="col-12 ">
        <div class="card px-5 py-3">
            <div class="card-body">
                <form class="repeater" action="../update/{{$order->id}}"  method="POST">
                    @csrf
                    <div class="row py-4">
                            <div class="col-2">
                            <img src="{{ URL::asset('/assets/images/enopoly.png') }}" alt="" height="40">
                            </div>
                            </div>
                    <section class="border-bottom py-2 d-flex justify-content-between">
                        
                        <div class="col-6" >
                            
                         <h5>Supplier Information</h5>
                         <p class="py-3">
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
                    
                    
                    <section class=" py-2 ">
                   
                    <h5>Item Details</h5>
                   
                    
                    
                    @if($order_details)
                    <div class="">
                        <table class="table mb-0 text-center table-bordered">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>ASIN</th>
                                    <th>Amazon Title</th>
                                    <th>Quantiy</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0;
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
                                    </tr>
                                    
                                
                                    
                                @endforeach
                                <tr>
                                    <td colspan="4"></td>
                                    <td ><b>Total:</b></td>
                                    <td class="text-right"><b>{{number_format($total,2)}}</b></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    
                    </div>
                     
                   
                    @endif
                   
                    
                    </section> 
                    <input type="hidden" name="total" value="{{$total}}"/>
                    <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                    <div class="d-flex justify-content-end my-2">
                   
                    
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

    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    
    <script>
    
        
     </script>
    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    
    
    
    
@endsection
