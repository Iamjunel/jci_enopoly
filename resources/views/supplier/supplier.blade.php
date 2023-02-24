@extends('layouts.master')

@section('title') Uncheck Supplier @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Sourcer @endslot
        @slot('title') Uncheck Supplier @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Uncheck Suppliers are the suppliers that need to be approved by the company to be part of.
                    </p>
                    <!-- Static Backdrop modal Button -->
                    <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                       + Add Uncheck Supplier
                    </button>
                    <button type="button" class="btn btn-success waves-effect waves-light my-2" disabled >
                       + Import Excel/CSV File
                    </button>


                    <!-- Add Onboarding Client Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                 <form action="supplier/store" method="POST">
                                                <div id="basic-example">
                                                    <!-- Seller Details -->
                                                    <h3>Uncheck Supplier Details</h3>
                                                    <section>
                                                       
                                                            @csrf
                                                            
                                                            <div class="row">
                                                                 <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-company-input">Company Name</label>
                                                                        <input type="text" class="form-control" id="basicpill-company-input" name="company_name" placeholder="Enter Company Name">
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
                                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                                        <input type="text" class="form-control" id="basicpill-phoneno-input" name="phone" placeholder="Enter Phone No.">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="website_link">Website Link</label>
                                                                        <input type="url" class="form-control website_link" id="website_link" name="website_link" placeholder="https://example.com">
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
                                                                                <option value="Restricted">Restricted</option>
                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">Notes</label>
                                                                        <textarea class="form-control" name="notes" placeholder="Enter some notes about the supplier"></textarea>
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
                               <th>Company Name</th>
                                <th>ASIN</th>
                                
                                <th>Website Link</th>
                                <th>Email Address</th>
                                <th>Contact</th>
                                <th>Notes</th>
                                <th>Status</th>
                                <th>Date Added</th>
                                <th>Added by</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($supplier as $client)
                            <tr>
                                 <td>{{$client->company_name}}</td>
                                <td>{{$client->asin}}</td>
                               
                                <td><a href="{{$client->website_link}}" target="blank_">{{$client->website_link}}</a></td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone}}</td>
                                 <td>{{$client->notes}}</td>
                                <td> 
                                    @if($client->status == "Uncheck")
                                    <span class="badge badge-pill badge-soft-danger font-size-11">
                                    @else 
                                    <span class="badge badge-pill badge-soft-success font-size-11">
                                    @endif    
                                    {{ucfirst($client->status)}}</span>
                                        
                                </td>
                                 <td>{{date('M d Y',strtotime($client->created_at))}}</td>
                                <td>{{$client->user->name}}</td>
                                <td> 
                                    <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#edit-{{$client->id}}" ><i class="bx bx-xs bx-pencil mr-1"></i></a>
                                    <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#delete-{{$client->id}}"><i class="bx bx-xs text-danger bx-trash mr-1"></i></a>
                                </td>
                                    <!--Update Status Modal -->
                                    <div class="modal fade bs-example-modal-sm" id="status-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Change Supplier Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="supplier/update/{{$client->id}}" method="POST">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-12 col-form-label">Client Current Status:</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="status">
                                                                                <option value="Incomplete" {{$client->status == 'Incomplete'}}>Incomplete</option>
                                                                                <option value="Completed" {{$client->status == 'Completed'}}>Completed</option>
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
                                </div>
                                
                                   <!-- Edit Modal -->
                                <div class="modal fade bs-example-modal-xl" id="edit-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Update Uncheck Supplier</h5>
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
                                                                        <label for="basicpill-company-input">Company Name</label>
                                                                        <input type="text" class="form-control" id="basicpill-company-input" name="company_name" value="{{$client->company_name}}" placeholder="Enter Company Name">
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
                                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                                        <input type="text" class="form-control" id="basicpill-phoneno-input" name="phone" value="{{$client->phone}}" placeholder="Enter Phone No.">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="website_link">Website Link</label>
                                                                        <input type="url" class="form-control" id="website_link"  name="website_link" value="{{$client->website_link}}" placeholder="example.com">
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
                                                                                <option value="Restricted" {{($client->types == "Restricted")? 'selected' : ''}}>Restricted</option>
                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-link-input">Notes</label>
                                                                        <textarea class="form-control" name="notes" placeholder="Enter some notes about the supplier">{{$client->notes}}</textarea>
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
    <script>
        $(document).ready(function(){
                $('#website_link').on("paste", function(e){   
                var element = this;
                setTimeout(function () {
                    var text = $(element).val();
                    cleanInput = text.replace('www.', '');
                    cleanInput = cleanInput.replace('http://', '');
                    cleanInput = cleanInput.replace('https://', '');
                    
                    $('#website_link').val(cleanInput);
                }, 100);    
                   
                

            });
        </script>
@endsection
