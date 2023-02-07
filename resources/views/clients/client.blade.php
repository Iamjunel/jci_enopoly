@extends('layouts.master')

@section('title') Onboarding Client @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Client Corr @endslot
        @slot('title') Onboarding Client @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Onboarding Clients are the clients approved by the company to be part of.
                    </p>
                    <!-- Static Backdrop modal Button 
                    <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                       + Add Onboarding Client
                    </button>
                    -->
                    <a href="client/create" class="btn btn-primary waves-effect waves-light my-2"> + Add Onboarding Client</a>
                    <button type="button" class="btn btn-success waves-effect waves-light my-2" disabled >
                       + Import Excel/CSV File
                    </button>


                    <!-- Add Onboarding Client Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Onboarding Client</h5>
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
                                                        <form action="client/store" method="POST">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-firstname-input">First name</label>
                                                                        <input type="text" class="form-control" id="basicpill-firstname-input" name="firstname" placeholder="Enter Your First Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Last name</label>
                                                                        <input type="text" class="form-control" id="basicpill-lastname-input" name="lastname" placeholder="Enter Your Last Name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                                        <input type="text" class="form-control" id="basicpill-phoneno-input" name="phone" placeholder="Enter Your Phone No.">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-email-input">Email</label>
                                                                        <input type="email" class="form-control" id="basicpill-email-input" name="email" placeholder="Enter Your Email ID">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 col-form-label">Company</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="company_id">
                                                                                @foreach ($companies as $company)
                                                                                    <option value="{{$company->id}}">{{ucfirst($company->name)}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 col-form-label">Payment Method</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="payment_method">
                                                                                <option value="VISA">VISA</option>
                                                                                <option value="ACH">ACH</option>
                                                                                <option value="AMEX">AMEX</option>
                                                                                <option value="WIRE">WIRE</option>
                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA)</label>
                                                                            <input type="text" class="form-control" name="rdia" id="basicpill-email-input" placeholder="Enter Remote Desktop Application" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA) Id</label>
                                                                            <input type="text" class="form-control" name="rdia_id" id="basicpill-email-input" placeholder="Enter Remote Desktop Application Id" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-address-input">Address</label>
                                                                            <input type="text" class="form-control" name="address" id="basicpill-email-input" placeholder="Enter Your Home Address" >
                                                                        </div>
                                                                    </div>
                                                                </div>                                                            
                                                        </section>
                                                        <h3>Facebook Platform Details</h3>
                                                        <section>
                                                            <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Email Address:</label>
                                                                            <input type="text" class="form-control" name="fb_email_address" id="basicpill-email-input" placeholder="Enter Your Email ID">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Password</label>
                                                                            <input type="text" class="form-control" name="fb_password" id="basicpill-email-input" placeholder="Enter Your Email ID">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </section>
                                                        
                                                     <h3>Store Details is in progress..</h3>

                                                
                                                </div>

                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="add_client" class="btn btn-primary">Save</button>
                                    </div>
                            </div>
                        </form>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Home Address</th>
                                <th>Email Address</th>
                                <th>Contact</th>
                                <th>Company</th>
                                <th>Payment Method</th>
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
                                <td>{{$client->payment_method}}</td>
                                <td> 
                                    @if($client->status == "Incomplete")
                                    <span class="badge badge-pill badge-soft-danger font-size-11">
                                        <a id="view" href="#" data-bs-toggle="modal" class="text-danger" data-bs-target="#status-{{$client->id}}">{{ucfirst($client->status)}}</a> </span>
                                    @else 
                                    <span class="badge badge-pill badge-soft-success font-size-11">
                                        <a id="view" href="#" data-bs-toggle="modal" class="text-success" data-bs-target="#status-{{$client->id}}">{{ucfirst($client->status)}}</a> </span>
                                    @endif    
                                        
                                </td>
                                <td>{{$client->user->name}}</td>
                                <td> <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#view-{{$client->id}}"><i class="bx bx-xs bx-user mr-2"></i> </a> 
                                    <a id="view" href="client/edit/{{$client->id}}" ><i class="bx bx-xs bx-pencil mr-1"></i></a>
                                 </td>
                                    <!--Update Status Modal -->
                                    <div class="modal fade bs-example-modal-sm" id="status-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Change Onboarding Client Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="client/update/{{$client->id}}" method="POST">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-12 col-form-label">Client Current Status:</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="status">
                                                                                <option value="Incomplete" {{$client->payment_method == 'Incomplete'}}>Incomplete</option>
                                                                                <option value="Completed" {{$client->payment_method == 'Completed'}}>Completed</option>
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
                                                    <h3>Payment Details(In-Progress)</h3>
                                                        <section>
                                                            
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
                                   <!-- Edit Modal -->
                                <div class="modal fade bs-example-modal-xl" id="edit-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Update Onboarding Client</h5>
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
                                                        <form action="client/update/{{$client->id}}" method="POST">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-firstname-input">First name</label>
                                                                        <input type="text" class="form-control" id="basicpill-firstname-input" name="firstname" value="{{$client->firstname}}" placeholder="Enter Your First Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Last name</label>
                                                                        <input type="text" class="form-control" id="basicpill-lastname-input" name="lastname" value="{{$client->lastname}}" placeholder="Enter Your Last Name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                                        <input type="text" class="form-control" id="basicpill-phoneno-input" name="phone" value="{{$client->phone}}" placeholder="Enter Your Phone No.">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-email-input">Email</label>
                                                                        <input type="email" class="form-control" id="basicpill-email-input" name="email" value="{{$client->email}}" placeholder="Enter Your Email ID">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 col-form-label">Company</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="company_id">
                                                                                @foreach ($companies as $company)
                                                                                    <option value="{{$company->id}}" {{($client->company_id == $company->id)? 'selected' : ''}}>{{ucfirst($company->name)}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 col-form-label">Payment Method</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="payment_method">
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
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA)</label>
                                                                            <input type="text" class="form-control" name="rdia" id="basicpill-email-input" value="{{$client->rdia}}" placeholder="Enter Remote Desktop Application" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA) Id</label>
                                                                            <input type="text" class="form-control" name="rdia_id" id="basicpill-email-input" value="{{$client->rdia_id}}"  placeholder="Enter Remote Desktop Application Id" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-address-input">Address</label>
                                                                            <input type="text" class="form-control" name="address" id="basicpill-email-input" value="{{$client->address}}" placeholder="Enter Your Home Address" >
                                                                        </div>
                                                                    </div>
                                                                </div>                                                            
                                                        </section>
                                                        <h3>Facebook Platform Details</h3>
                                                        <section>
                                                            <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Email Address:</label>
                                                                            <input type="text" class="form-control" name="fb_email_address" id="basicpill-email-input" value="{{$client->fb_email_address}}" placeholder="Enter Your Fb Email ID">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Password</label>
                                                                            <input type="text" class="form-control" name="fb_password" id="basicpill-email-input" value="{{$client->fb_password}}" placeholder="Enter Your Fb password">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </section>
                                                        <h3>Client Status</h3>
                                                        <section>
                                                            <div class="row">
                                                                    <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 col-form-label">Client Current Status:</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="status">
                                                                                <option value="Incomplete" {{($client->status == 'Incomplete')?'selected' : ''}}>Incomplete</option>
                                                                                <option value="Completed" {{($client->status == 'Completed')?'selected':''}}>Completed</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                        </section>
                                                        
                                                        
                                                     <h3>Store Details is in progress..</h3>

                                                    </div>

                                                </div>
                                                <!-- end card body -->
                                            </div>
                                                <!-- end card -->
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit"  name="update_client" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
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
