@extends('layouts.master')

@section('title') Purchase Order @endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
  
@endsection


@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Purchaser @endslot
        @slot('title') Create Purchase Order @endslot
    @endcomponent
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="repeater" action="update/{{$order->id}}"  method="POST">
                    @csrf
                    <section class="border-bottom py-2 d-flex justify-content-between">
                        <div class="col-6" >
                         <h4>Supplier Information</h4>
                         <p class="py-3">
                            <b>{{$order->supplier->asin}}</b><br/>
                            <b>{{$order->supplier->company_name}}</b><br/>
                            {{$order->supplier->email}}<br/>
                            {{$order->supplier->phone}}<br/>
                            {{$order->supplier->website_link}}
                         </p>
                        </div>
                        <div class="col-6"> 
                            <h4>Order Details</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">P.O # <span class="text-danger">*</span></label>
                                        <input type="text" name="purchase_order" class="form-control" value="{{$order->purchase_order}}" required/>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="productdesc">Notes</label>
                                        <textarea class="form-control" name="description"  rows="5" >{{$order->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="col-md-12 col-form-label">Status:</label>
                                    <div class="col-md-12">
                                        <select class="form-select" name="status">
                                            <option value="Pending" {{$order->status == 'Pending'}}>Pending</option>
                                            <option value="Approved" {{$order->status == 'Approved'}}>Approved</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                   
                        </div>
                        
                                                                             
                    </section>
                    
                    
                    <section class="border-bottom py-2 ">
                    <div class="d-flex justify-content-between">
                    <h4>Item Details</h4>
                    <button type="button" class="btn btn-primary btn-sm my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                       <i class="bx bx-sm bx-cart"> </i>
                    </button>
                    </div>
                    
                    @if($order_details)
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>ASIN</th>
                                    <th>Amazon Title</th>
                                    <th>Quantiy</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th></th>
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
                                        <td style="width:2%"><span><a  class="text-danger" href="destroyItem/{{$or->id}}"><i class="bx bx-trash"></i></a></td>
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
                    <a href="{{route('purchaser_product.pending_po')}}" class="btn btn-light px-4 mx-1" >Cancel</a>
                    <button type="submit" name="add_client" class="btn btn-primary px-4 mx-1">Save</button>
                    </div>
                </form>
                <!-- Add Onboarding Client Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-md" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Product Item</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                 <form action="store_order_details" method="POST">
                                                <div id="basic-example">
                                                    <section>
                                                       
                                                            @csrf
                                                            
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3 col-md-12">
                                                                        <label class="form-label">Product <span class="text-danger">*</span></label>
                                                                        <select class="form-select products select2" name="product_id"></select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">Quantity</label>
                                                                         <input type="number" class="form-control" name="quantity" value="1"/>
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
                                        <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                                        <input type="hidden" name="order_id" value="{{$order->id}}"/>
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
    $(document).ready(function() {
        var options = {!! json_encode(array_values($products)) !!};
       
        $(".products").empty().select2({
            data: options
            
            
        }); 
        
        $(".products").select2({
            width:'100%',
            dropdownParent: $('#staticBackdrop .modal-content')
        });
    });
    
        
     </script>
    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    
    
    
    
@endsection
