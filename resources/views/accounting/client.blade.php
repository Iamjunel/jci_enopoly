@extends('layouts.master')

@section('title') Onboarding Client @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Accounting @endslot
        @slot('title')Approved Onboarding Client @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Home Address</th>
                                <th>Email Address</th>
                                <th>Contact</th>
                                <th>Company</th>
                                
                                <th>Status</th>
                                <th>Added by</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <td>{{$client->firstname}} {{$client->lastname}}</td>
                                 <td>{{$client->address}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone}}</td>
                                @if($client->company_id)
                                <td>{{$client->company->name}}</td>
                                @else 
                                <td></td>
                                @endif
        
                                <td> 
                                    
                                    <span class="badge badge-pill badge-soft-success font-size-11">
                                        {{ucfirst($client->status)}}
                                    </span>
                                </td>
                                <td>{{$client->user->name}}</td>
                                <td> <a id="view" href="#" data-bs-toggle="modal" title="view details"  data-bs-target="#view-{{$client->id}}"><i class="bx bx-xs bx-user mr-2"></i> </a> 
                                      <a id="view" href="#" data-bs-toggle="modal" class="text-success" title="Add Payment" data-bs-target="#status-{{$client->id}}"><i class="bx bx-xs bx-credit-card mr-1"></i></a></a> </span>
                                 </td>
                                    <!--Update Status Modal -->
                                    <div class="modal fade bs-example-modal-md" id="status-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Add Payment Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="store" method="POST">
                                                        @csrf
                                                    <div class="modal-body">
                                                        
                                                        <div class="row">

                                                                    <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-12 col-form-label">Type<span class="text-danger">*</span>:</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="type">
                                                                                <option value="VISA" {{($client->payment_method == 'VISA')? 'selected' : ''}}>VISA</option>
                                                                                <option value="ACH" {{($client->payment_method == 'ACH')? 'selected' : ''}}>ACH</option>
                                                                                <option value="AMEX" {{($client->payment_method == 'AMEX')? 'selected' : ''}}>AMEX</option>
                                                                                <option value="WIRE" {{($client->payment_method == 'WIRE')? 'selected' : ''}}>WIRE</option>
                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">Name <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="name"  id="basicpill-firstname-input" placeholder="Enter Your Name" value="" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                        </div>
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">Billing Address <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="billing_address" id="basicpill-firstname-input" placeholder="Billing Address" value="" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                        </div>
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">Card Number/ Account No. <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="number" id="basicpill-firstname-input" placeholder="Enter Number" value="" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="client_id" value="{{$client->id}}"/>
                                                         <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"  name="update_client" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                    </div>
                                    <!-- View Modal -->
                                <div class="modal fade bs-example-modal-xl" id="view-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Onboarding Client Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="basic-example">
                                                        <!-- Seller Details -->
                                                        <h3>Client Details</h3>
                                                        <section>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">First name</label>
                                                                            <input type="text" class="form-control" id="basicpill-firstname-input" placeholder="Enter Your First Name" value="{{$client->firstname}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-lastname-input">Last name</label>
                                                                            <input type="text" class="form-control" id="basicpill-lastname-input" placeholder="Enter Your Last Name" value="{{$client->lastname}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-phoneno-input">Contact No.</label>
                                                                            <input type="text" class="form-control" id="basicpill-phoneno-input" placeholder="Enter Your Phone No." value="{{$client->phone}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-email-input">Email Address</label>
                                                                            <input type="email" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->email}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Company</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->company->name}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Address</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->address}}" disabled>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA)</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->rdia}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA) Id</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->rdia_id}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Added By @ Date</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->user->name}} @ {{date('M d Y',strtotime($client->created_at))}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    @if($client->approved_at)
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Approved by @ Date</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->user->name}} @ {{date('M d Y',strtotime($client->approved_at))}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>                                                            
                                                        </section>
                                                        <h3>Facebook Platform Details</h3>
                                                        <section>
                                                            <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Email Address:</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->fb_email_address}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Password</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->fb_password}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </section>
                                                        
                                                        <section class="border-bottom py-2">
                                                    <h3>Store Details</h3>
                                                    @if(count($client->store_details))

                                                    <div data-repeater-list="store">
                                                     @foreach($client->store_details as $value)
                                                        <div data-repeater-item class="row">
                                                            
                                                            <div class="mb-3 col-lg-2">
                                                                <label for="name">Platform</label>
                                                                <input type="text" id="name"  name="store_name" class="form-control" value="{{$value->platform}}"  placeholder="Enter Store Name" disabled/>
                                                            </div>

                                                            <div class="mb-3 col-lg-2">
                                                                <label for="name">Name</label>
                                                                <input type="text" id="name"  name="store_name" class="form-control" value="{{$value->name}}"  placeholder="Enter Store Name" disabled/>
                                                            </div>

                                                            <div class="mb-3 col-lg-2">
                                                                <label for="email">Website Link:</label>
                                                                <input type="text" id="message" class="form-control" name="store_line" value="{{$value->link}}" placeholder="http://example.com" disabled/>
                                                            </div>

                                                            <div class="mb-3 col-lg-2">
                                                                <label for="email">Email/Username :</label>
                                                                <input type="text" id="email" class="form-control" name="store_username" value="{{$value->username}}" placeholder="Enter Store Email/Username" disabled/>
                                                            </div>

                                                            <div class="mb-3 col-lg-2">
                                                                <label for="subject">Password</label>
                                                                <input type="text" id="subject" class="form-control" name="store_password" value="{{$value->password}}" placeholder="Enter Store Password" disabled />
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    
                                                    @else 
                                                    <p class="text-center">No Store Details Available.</p>
                                                    @endif
                                                    </section>
                                                    <h3>Payment Details</h3>
                                                        <section>
                                                             @if(count($client->store_details))
                                                            @foreach($client->payment_details as $key => $pay)
                                                           
                                                            
                                                            <div class="row border-bottom">
                                                                <h5>{{$pay->type}}</h5>
                                                                    <div class="col-lg-3">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Name</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value= "{{$pay->name}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-12 col-form-label">Card No./ Account No.</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$pay->number}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-12 col-form-label">Billing Address</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$pay->billing_address}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-1">
                                                                        <div class="mb-3 mt-3">
                                                                            <form action="destroy/{{$pay->id}}" method="POST">
                                                                                @csrf 
                                                                                <label class="col-md-12 col-form-label"></label>
        
                                                                            <input type="submit" class=" btn btn-primary" value="Remove">
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                        
                                                                
                                                                @endforeach  
                                                                 @else 
                                                    <p class="text-center">No Payment Details Available.</p>
                                                    @endif  
                                                        </section>
                                                        
                                                        
                                                            
                                                        
                                                    </div>

                                                </div>
                                                <!-- end card body -->
                                            </div>
                                                <!-- end card -->
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            </div>
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
