@extends('layouts.master')

@section('title') Valid/Invalid Supplier @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Checker @endslot
        @slot('title') Valid | Invalid Supplier @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Valid | Invalid Suppliers are the suppliers that need to be approved by the caller to be part of.
                    </p>
                    

                    <!-- Add Onboarding Client Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Prospected Supplier</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                 <form action="supplier/store" method="POST">
                                                <div id="basic-example">
                                                    <!-- Seller Details -->
                                                    <h3>Prospected Supplier Details</h3>
                                                    <section>
                                                       
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-firstname-input">First name</label>
                                                                        <input type="text" class="form-control" id="basicpill-firstname-input" name="firstname" placeholder="Enter First Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Last name</label>
                                                                        <input type="text" class="form-control" id="basicpill-lastname-input" name="lastname" placeholder="Enter Last Name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                                        <input type="text" class="form-control" id="basicpill-phoneno-input" name="phone" placeholder="Enter Phone No.">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-email-input">Email</label>
                                                                        <input type="email" class="form-control" id="basicpill-email-input" name="email" placeholder="Enter Email Address">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-asin-input">ASIN</label>
                                                                        <input type="text" class="form-control" id="basicpill-asin-input" name="asin" placeholder="Enter ASIN No.">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-company-input">Company Name</label>
                                                                        <input type="text" class="form-control" id="basicpill-company-input" name="company_name" placeholder="Enter Company Name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">Website Link</label>
                                                                        <input type="url" class="form-control" id="basicpill-link-input" name="website_link" placeholder="https://example.com">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 ">Type</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="types">
                                                                                <option value="Distributor">Distributor</option>
                                                                                <option value="Dealer">Dealer</option>
                                                                                <option value="Whole Saler">Whole Saler</option>
                                                                                <option value="Retailer">Retailer</option>
                                                                                <option value="Brand">Brand</option>
                                                
                                                                            </select>
                                                                        </div>
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
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="add_supplier" class="btn btn-primary">Save</button>
                                    </div>
                            </div>
                        </form>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>ASIN</th>
                                <th>Company Name</th>
                                <th>Website Link</th>
                                <th>Email Address</th>
                                <th>Asin</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Date Added</th>
                                <th>Added by</th>
                               
                                
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($supplier as $client)
                            <tr>
                                <td>{{$client->firstname}} {{$client->lastname}}</td>
                                <td>{{$client->asin}}</td>
                                <td>{{$client->company_name}}</td>
                                <td><a href="{{$client->website_link}}" target="blank_">{{$client->website_link}}</a></td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->asin}}</td>
                                <td>{{$client->phone}}</td>
                                <td> 
                                   @if($client->status == "Valid")
                                    <span class="badge badge-pill badge-soft-info font-size-11">
                                        <a id="view" href="#" data-bs-toggle="modal" class="text-info" data-bs-target="#status-{{$client->id}}">{{ucfirst($client->status)}}</a> </span>
                                    @else 
                                    <span class="badge badge-pill badge-soft-warning font-size-11">
                                        <a id="view" href="#" data-bs-toggle="modal" class="text-warning" data-bs-target="#status-{{$client->id}}">{{ucfirst($client->status)}}</a> </span>
                                    @endif
                                        
                                </td>
                                 <td>{{date('M d Y',strtotime($client->checker_updated_at))}}</td>
                                <td>{{$client->checker->name}}</td>
                                <!--<td> 
                                    <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#edit-{{$client->id}}" ><i class="bx bx-xs bx-pencil mr-1"></i></a>
                                    <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#delete-{{$client->id}}"><i class="bx bx-xs text-danger bx-trash mr-1"></i></a>
                                </td>
                            -->
                                    <!--Update Status Modal -->
                                    <div class="modal fade bs-example-modal-sm" id="status-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Change Supplier Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="../supplier/update/{{$client->id}}" method="POST">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-12 col-form-label">Supplier Status:</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="status">
                                                                                <option value="Valid" {{($client->status == 'Valid')? 'selected' : ''}}>Valid</option>
                                                                                <option value="Invalid" {{($client->status == 'Invalid')? 'selected' : ''}}>Invalid</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="productdesc">Checker Notes</label>
                                                                                <textarea class="form-control" name="checker_notes" id="productdesc" rows="5" placeholder="Input some notes">{{$client->checker_notes}}</textarea>
                                                                            </div>

                                                                        </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="checker_id" value="{{Auth::user()->id}}"/>
                                                        <input type="hidden" name="checker_updated_at" value="{{date('Y-m-d h:i:s')}}"/>
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"  name="update_client" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                    </div>
                                </div>
                                
                                   <!-- Edit Modal -->
                                <div class="modal fade bs-example-modal-xl" id="edit-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Uncheck Supplier</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                 <form action="supplier/update/{{$client->id}}" method="POST">
                                                <div id="basic-example">
                                                    <!-- Seller Details -->
                                                    <h3>Uncheck Supplier Details</h3>
                                                    <section>
                                                       
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-firstname-input">First name</label>
                                                                        <input type="text" class="form-control" id="basicpill-firstname-input" name="firstname" value="{{$client->firstname}}" placeholder="Enter First Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Last name</label>
                                                                        <input type="text" class="form-control" id="basicpill-lastname-input" name="lastname" value="{{$client->lastname}}" placeholder="Enter Last Name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                                        <input type="text" class="form-control" id="basicpill-phoneno-input" name="phone" value="{{$client->phone}}" placeholder="Enter Phone No.">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-email-input">Email</label>
                                                                        <input type="email" class="form-control" id="basicpill-email-input" name="email" value="{{$client->email}}" placeholder="Enter Email Address">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-asin-input">ASIN</label>
                                                                        <input type="text" class="form-control" id="basicpill-asin-input" name="asin" value="{{$client->asin}}" placeholder="Enter ASIN No.">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-company-input">Company Name</label>
                                                                        <input type="text" class="form-control" id="basicpill-company-input" name="company_name" value="{{$client->company_name}}" placeholder="Enter Company Name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">Website Link</label>
                                                                        <input type="url" class="form-control" id="basicpill-link-input" name="website_link" value="{{$client->website_link}}" placeholder="http://example.com">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 ">Type</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="types">
                                                                                <option  value="Distributor" {{($client->types == "Distributor")? 'selected' : ''}}>Distributor</option>
                                                                                <option value="Dealer" {{($client->types == "Dealer")? 'selected' : ''}}>Dealer</option>
                                                                                <option value="Whole Saler" {{($client->types == "Whole Saler")? 'selected' : ''}}>Whole Saler</option>
                                                                                <option value="Retailer" {{($client->types == "Retailer")? 'selected' : ''}}>Retailer</option>
                                                                                <option value="Brand" {{($client->types == "Brand")? 'selected' : ''}}>Brand</option>
                                                
                                                                            </select>
                                                                        </div>
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
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="add_supplier" class="btn btn-primary">Save</button>
                                    </div>
                            </div>
                        </form>
                        </div>
                                </div>

                                 <!--  Delete Modal-->
                                <div class="modal fade  bs-example-modal-sm" id="delete-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mySmallModalLabel">Delete Uncheck Supplier</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete uncheck supplier {{$client->firstname}} {{$client->lastname}}  ?</p>
                                                
                                            </div>
                                            <form action="supplier/destroy/{{$client->id}}" method="POST">
                                                @csrf
                                                
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Yes I'm sure</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                
                               
                                
                               
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
